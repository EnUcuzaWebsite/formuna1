<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return $this->record->name;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        unset($data['change_password']);

        $old_values = $record->getOriginal();
        $record->updateQuietly($data);
        $changed_fields = $record->getChanges();

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

        $record->log([
            'type' => 'updated',
            'message' =>  '
                        <strong>
                            <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                '.auth()->user()->name.'
                            </a>
                        </strong>
                        <small> Düzenledi </small>
                        <strong>
                            <a href="'.route('filament.admin.resources.users.view', ['record' => $record]).'">
                                '.$data['name'].'
                            </a>
                        </strong>',
        ], $diff);

        return $record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Avatar')
                    ->acceptedFileTypes(['image/*'])
                    ->extraAttributes([
                        'class' => 'h-',
                    ]),
                Fieldset::make('Overview')
                    ->columnSpan(1)
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->columnSpanFull()
                            ->required(),
                    ]),

                Fieldset::make('Password')
                    ->columnSpan(1)
                    ->visible(fn () => auth()->user()?->hasRole('super_admin'))
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
                        Toggle::make('change_password')
                            ->label('Change Password')
                            ->live()
                            ->default(false),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            // ->disabled(fn(Get $get) => !$get('change_password'))
                            ->visible(fn (Get $get) => auth()->user()?->hasRole('super_admin') && $get('change_password'))
                            ->columnSpanFull()
                            ->required(),
                    ]),

                Fieldset::make('Roles & Status')
                    ->columnSpan(1)
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->required(),
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->label('Roles')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->options(
                                fn () => Role::query()
                                    ->when(
                                        ! auth()->user()?->hasRole('super_admin'),
                                        fn ($query) => $query->whereNotIn('name', ['super_admin', 'Panel Admin'])
                                    )
                                    ->pluck('name', 'id')
                            )
                            ->disabled(fn () => (! auth()->user()?->hasRole('super_admin') && $this->record->hasRole('super_admin')) || ($this->record->hasRole('Panel Admin') && auth()->user()?->hasRole('Panel Admin'))),
                    ]),

                RichEditor::make('bio')
                    ->label('Biografi')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
