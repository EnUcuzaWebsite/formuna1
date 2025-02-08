<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use App\Models\Category;
use App\Models\Topic;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;

class EditComment extends EditRecord
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('comment')
                    ->label('İçerik')
                    ->columnSpanFull()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->required(),
            ]);
    }
}
