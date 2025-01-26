<?php

namespace App\Livewire;

use App\Models\Category;
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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CreateButton extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;


    public function modalAction()
    {
        return Action::make('modal')
            ->label('')

            ->icon('heroicon-c-plus')
            ->form([
                Group::make([
                    TextInput::make('title')
                        ->label('Başlık')
                        ->required(),
                    Select::make('category_id')
                        ->label('Kategori')
                        ->extraAttributes(['class' => 'text-white '])
                        ->native(false)
                        ->live()
                        ->options(Category::all()->pluck('name', 'id'))
                        ->required(),
                    Select::make('topic_id')
                        ->label('Konu')
                        ->native(false)
                        ->disabled(fn(Get $get) => !$get('category_id'))
                        ->options(fn(Get $get) => $get('category_id') ? Topic::where('category_id', $get('category_id'))->get()->pluck('name', 'id') : [])
                        ->required(),
                    RichEditor::make('content')
                        ->label('İçerik')
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
                Post::create($data);
                Notification::make()
                    ->title('Form Oluşturuldu')
                    ->success()
                    ->icon('heroicon-o-document-text')
                    ->send();
                redirect(route('home'));
            });

    }

    public function render()
    {
        return view('livewire.create-button');
    }
}
