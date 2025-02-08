<?php

namespace App\Livewire;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class FollowButton extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?User $user;

    public function mount(User &$user)
    {
        $this->user = $user;
    }

    public function followAction(): Action
    {
        return Action::make('follow')
            ->hiddenLabel()
            ->extraAttributes([
                'style'=> 'padding: 0 !important'
            ])
            ->icon($this->user->isfollowed() ? 'heroicon-s-user-plus' : 'heroicon-o-user-plus')
            ->action(function () {
                if($this->user->isfollowed()){
                    Follow::where(['follower_id' => auth()->id(), 'followed_id' => $this->user->id])->delete();
                    Notification::make()
                        ->title('Kullanıcı Takipten Çıkarıldı')
                        ->warning()
                        ->icon('heroicon-o-user-plus')
                        ->send();
                }
                else{
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
