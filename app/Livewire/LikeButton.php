<?php

namespace App\Livewire;

use App\Models\LikedPost;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Support\Contracts\TranslatableContentDriver;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class LikeButton extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?Post $post;

    public function mount(Post $post){
        $this->post = $post;
    }

    public function likeAction(): Action
    {
        return Action::make('like')
            ->hiddenLabel()
            ->icon($this->post->isLiked() ? 'heroicon-s-hand-thumb-up' : 'heroicon-o-hand-thumb-up')
            ->action(function () {
                if ($this->post->isLiked()) {
                    LikedPost::where(['post_id' => $this->post->id, 'user_id' => auth()->id()])->delete();
                    Notification::make()
                        ->title('Beğeni Kaldırıldı')
                        ->warning()
                        ->icon('heroicon-s-hand-thumb-down')
                        ->send();
                }
                else{
                    $this->post->likepost();
                    Notification::make()
                        ->title('Forum Beğenildi')
                        ->success()
                        ->icon('heroicon-s-hand-thumb-up')
                        ->send();
                }
            });
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
