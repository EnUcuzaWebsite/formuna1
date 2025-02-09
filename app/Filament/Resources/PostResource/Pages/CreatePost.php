<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Category;
use App\Models\Topic;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->disabled(fn (Get $get) => ! $get('category_id'))
                    ->options(fn (Get $get) => $get('category_id') ? Topic::where('category_id', $get('category_id'))->get()->pluck('name', 'id') : [])
                    ->required(),
                RichEditor::make('content')
                    ->label('İçerik')
                    ->columnSpanFull()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->required(),
            ]);
    }
}
