<?php

namespace App\Filament\Resources\TopicResource\Pages;

use App\Filament\Resources\TopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListTopics extends ListRecords
{
    protected static string $resource = TopicResource::class;

    protected static ?string $title = 'Konular';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Konu Olşutur')
                ->icon('heroicon-o-plus-circle'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Adı')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('detail')
                    ->label('Açklama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->prefix('/')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->datetime()
                    ->searchable()
                    ->sortable(),
            ]);
    }
}
