<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Livewire\Component;

class CommentAction extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function commentAction()
    {
        return Action::make('comment')
            ->label('Yorum Yap')
            ->extraAttributes([
                'class' => 'comment-button',
            ])
            ->icon('heroicon-o-chat-bubble-left-right')
            ->form([
                Group::make([
                    RichEditor::make('comment')
                        ->label('Yorum')
                        ->extraInputAttributes([
                            'style' => 'min-height: 13rem;',
                        ])
                        ->disableToolbarButtons([
                            'attachFiles',
                        ])
                        ->required(),
                ]),
            ])
            ->action(function (array $data) {
                $data['user_id'] = auth()->id();
                $data['post_id'] = $this->post->id;
                $newcomment = Comment::createQuietly($data);

                $newcomment->log([
                    'type' => 'create comment',
                    'message' => '<strong>
                                         <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                            '.auth()->user()->name.'
                                        </a>
                                        </strong>
                                      <small> Yorum Yaptı </small>
                                      <strong>
                                        <a href="'.route('filament.admin.resources.posts.view', ['record' => $this->post]).'">
                                            '.$this->post->id.' -> post
                                        </a>
                                      </strong>
                                       ',
                ]);

                Notification::make()
                    ->title('Yorum Oluşturuldu')
                    ->success()
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->send();
                redirect(route('post.show', $this->post));
            });

    }


    public function render()
    {
        return view('livewire.comment-action');
    }
}
