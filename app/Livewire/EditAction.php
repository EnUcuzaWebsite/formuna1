<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Livewire\Component;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class EditAction extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?User $user ;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function editAction(): Action
    {
        return Action::make('edit')
            ->label('Düzenle')
            ->icon('heroicon-o-pencil')
            ->fillForm([
                'avatar' => $this->user->getFirstMediaUrl('avatar'),
                'name' => $this->user->name,
                'email' => $this->user->email,
                'bio' => $this->user->bio,
            ])
            ->form([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->columnSpanFull()
                    ->model($this->user)
                    ->hiddenLabel()
                    ->acceptedFileTypes(['image/*']),
                TextInput::make('name')
                ->label('Kullanıcı Adı'),
                TextInput::make('email')
                    ->label('Email'),
                Toggle::make('change_password')
                    ->label('Şifre Değiştirme')
                    ->live()
                    ->default(false),
                TextInput::make('password')
                    ->label('Şifre')
                    ->password()
                    ->revealable()
                    ->visible(fn (Get $get) => auth()->user()?->hasRole('super_admin') && $get('change_password'))
                    ->columnSpanFull()
                    ->required(),
                RichEditor::make('bio')
                    ->label('Hakkımda')
                    ->extraAttributes([
                        'class' => 'edit-bio',
                    ]),
            ])
            ->action(function (array $data) {
                unset($data['change_password']);
                $old_values = $this->user->getOriginal();
                $this->user->updateQuietly($data);
                $changed_fields = $this->user->getChanges();

                $diff = [];
                foreach ($changed_fields as $key => $new_value) {
                    if (! in_array($key, ['password', 'updated_at', 'remember_token'])) {
                        $diff[] = [
                            'field' => $key,
                            'old' => $old_values[$key] ?? null,
                            'new' => $new_value,
                        ];
                    }

                }

                $this->user->log([
                    'type' => 'updated',
                    'message' =>  '
                        <strong>
                            <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                '.auth()->user()->name.'
                            </a>
                        </strong>
                        <small> Düzenledi </small>
                        <strong>
                            <a href="'.route('filament.admin.resources.users.view', ['record' => $this->user]).'">
                                '.$data['name'].'
                            </a>
                        </strong>',
                ], $diff);

                Notification::make()
                    ->title('Kullanıcı Düzenlendi')
                    ->success()
                    ->icon('heroicon-o-pencil')
                    ->send();
                redirect(route('user.details', $this->user));
            });


    }

    public function render()
    {
        return view('livewire.edit-action');
    }
}
