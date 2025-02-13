<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\SavedPost;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class SaveButton extends Component implements HasActions, HasForms
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function saveAction(): Action
    {
        return Action::make('save')
            ->hiddenLabel()
            ->icon($this->post->issaved() ? 'heroicon-s-bookmark' : 'heroicon-o-bookmark')
            ->action(function () {
                if ($this->post->issaved()) {
                    $unsaved_post = SavedPost::where(['post_id' => $this->post->id, 'user_id' => auth()->id()])->first();

                    $unsaved_post->log([
                        'type' => 'unsave',
                        'message' => '<strong>
                                         <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                            '.auth()->user()->name.'
                                        </a>
                                        </strong>
                                      <small> kaydetmeyi kaldırdı </small>
                                      <strong>
                                        <a href="'.route('filament.admin.resources.posts.view', ['record' => $this->post]).'">
                                            '.$this->post->id.' -> post
                                        </a>
                                      </strong>
                                       ',
                    ]);
                    $unsaved_post->deleteQuietly();

                    Notification::make()
                        ->title('Kaydedilenlerden Çıkarıldı')
                        ->warning()
                        ->icon('heroicon-o-bookmark')
                        ->send();

                } else {
                    $this->post->savepost();
                    Notification::make()
                        ->title('Forum Kaydedildi')
                        ->success()
                        ->icon('heroicon-s-bookmark')
                        ->send();
                }
            });

    }


    public function render()
    {
        return view('livewire.save-button');
    }
}
