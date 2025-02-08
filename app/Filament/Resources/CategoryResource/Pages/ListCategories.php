<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected static ?string $title = 'Kategoriler';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Kategori Olşutur')
                ->icon('heroicon-o-plus-circle'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('İsim')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('detail')
                    ->label('Açıklama'),
                TextColumn::make('slug')
                    ->prefix('/')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
            ]);
    }
}
