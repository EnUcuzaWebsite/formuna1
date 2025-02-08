<?php

namespace App\Filament\Resources\FollowResource\Pages;

use App\Filament\Resources\FollowResource;
use App\Models\Follow;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListFollows extends ListRecords
{
    protected static string $resource = FollowResource::class;

    protected static ?string $title = 'Takipler';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('follower.name')
                    ->columnSpanFull()
                    ->color('success')
                    ->label('Takip Eden')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Follow $record) => route('filament.admin.resources.users.view', $record->follower)),
                TextColumn::make('followed.name')
                    ->label('Takip Edilen')
                    ->color('info')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Follow $record) => route('filament.admin.resources.users.view', $record->followed)),
                TextColumn::make('created_at')
                    ->label('Tarih')
                    ->datetime()
                    ->searchable()
                    ->sortable(),
            ]);
    }


}
