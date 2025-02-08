<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\SavedPost;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;
use Spatie\MediaLibrary\HasMedia;

class PostActionGroup extends Component implements HasForms, HasActions
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
                if($this->post->issaved()){
                    SavedPost::where(['post_id' => $this->post->id, 'user_id' => auth()->id()])->delete();
                    Notification::make()
                        ->title('Kaydedilenlerden Çıkarıldı')
                        ->warning()
                        ->icon('heroicon-o-bookmark')
                        ->send();
                }
                else{
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
        return view('livewire.post-action-group');
    }
}
