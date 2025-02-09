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
use Livewire\Component;

class LikeButton extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function likeAction(): Action
    {
        return Action::make('like')
            ->hiddenLabel()
            ->icon($this->post->isLiked() ? 'heroicon-s-hand-thumb-up' : 'heroicon-o-hand-thumb-up')
            ->action(function () {
                if ($this->post->isLiked()) {
                    $unliked_post = LikedPost::where(['post_id' => $this->post->id, 'user_id' => auth()->id()])->first();
                    $unliked_post->log([
                        'type' => 'unlike',
                        'message' => '<strong>
                                         <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                            '.auth()->user()->name.'
                                        </a>
                                        </strong>
                                      <small> beğeniyi kaldırdı </small>
                                      <strong>
                                        <a href="'.route('filament.admin.resources.posts.view', ['record' => $this->post]).'">
                                            '.$this->post->id.' -> post
                                        </a>
                                      </strong>
                                       ',
                    ]);
                    $unliked_post->deleteQuietly();
                    Notification::make()
                        ->title('Beğeni Kaldırıldı')
                        ->warning()
                        ->icon('heroicon-s-hand-thumb-down')
                        ->send();
                } else {
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
