<?php

namespace App\Filament\Resources\LikeResource\Pages;

use App\Filament\Resources\LikeResource;
use App\Models\LikedPost;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListLikes extends ListRecords
{
    protected static string $resource = LikeResource::class;

    protected static ?string $title = 'Beğenmeler';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Beğenen')
                    ->color('success')
                    ->searchable()
                    ->sortable()
                    ->url(fn (LikedPost $record) => route('filament.admin.resources.users.view', $record->user)),
                TextColumn::make('post.title')
                    ->label('Post')
                    ->color('info')
                    ->searchable()
                    ->sortable()
                    ->url(fn (LikedPost $record) => route('filament.admin.resources.posts.view', $record->post)),
                TextColumn::make('created_at')
                    ->label('Tarih')
                    ->datetime()
                    ->searchable()
                    ->sortable(),
            ]);
    }
}
