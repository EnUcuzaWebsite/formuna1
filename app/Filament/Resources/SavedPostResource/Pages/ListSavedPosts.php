<?php

namespace App\Filament\Resources\SavedPostResource\Pages;

use App\Filament\Resources\SavedPostResource;
use App\Models\SavedPost;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListSavedPosts extends ListRecords
{
    protected static string $resource = SavedPostResource::class;

    protected static ?string $title = 'Kaydetmeler';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Kaydeden')
                    ->color('success')
                    ->searchable()
                    ->sortable()
                    ->url(fn(SavedPost $record) => route('filament.admin.resources.users.view', $record->user)),
                TextColumn::make('post.title')
                    ->label('Post')
                    ->color('info')
                    ->searchable()
                    ->url(fn(SavedPost $record) => route('filament.admin.resources.posts.view', $record->post)),

            ]);
    }
}
