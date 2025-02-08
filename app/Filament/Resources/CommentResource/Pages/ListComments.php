<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected static ?string $title = 'Yorumlar';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Yorum Sahibi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('post.title')
                    ->label('Post Başlığı')
                    ->searchable(),
                TextColumn::make('post.category.name')
                    ->label('Kategori'),
                TextColumn::make('post.topic.name')
                    ->label('Konu'),
                TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->datetime()
                    ->searchable()
                    ->sortable(),
            ]);
    }
}
