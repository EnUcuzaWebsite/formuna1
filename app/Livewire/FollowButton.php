<?php

namespace App\Livewire;

use App\Models\Follow;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class FollowButton extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?User $user;
    public bool $button;

    public function mount(User &$user, bool $button = false): void
    {
        $this->button = $button;
        $this->user = $user;
    }

    public function followAction(): Action
    {
        return Action::make('follow')
            ->label($this->button ? 'Takip Et' : '')
            ->extraAttributes([
                'style' => 'padding: 0 !important',
            ])
            ->requiresConfirmation($this->user->isfollowed() ?? false)
            ->modalHeading($this->user->isfollowed() ?  $this->user->name.' isimli kullanıcıyı takipten çıkarmak istediğinize emin misiniz?' : false)
            ->modalSubmitActionLabel('Takipten Çıkar')
            ->icon($this->user->isfollowed() ? 'heroicon-s-user-plus' : 'heroicon-o-user-plus')
            ->action(function () {
                if ($this->user->isfollowed()) {
                    $unfollow = Follow::where(['follower_id' => auth()->id(), 'followed_id' => $this->user->id])->first();

                    $unfollow->log([
                        'type' => 'unfollow',
                        'message' =>  '
                                <strong>
                                    <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                        '.auth()->user()->name.'
                                    </a>

                                </strong>
                                <small> Takip Etti </small>
                                <strong>
                                    <a href="'.route('filament.admin.resources.users.view', ['record' => $this->user]).'">
                                        '.$this->user->name.'
                                    </a>
                                </strong>',
                    ]);

                    $unfollow->deleteQuietly();


                    Notification::make()
                        ->title('Kullanıcı Takipten Çıkarıldı')
                        ->warning()
                        ->icon('heroicon-o-user-plus')
                        ->send();
                } else {
                    $this->user->follow();
                    Notification::make()
                        ->title('Kullanıcı Takip Edildi')
                        ->success()
                        ->icon('heroicon-s-user-plus')
                        ->send();
                }
            });
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
