<?php

namespace App\Filament\Resources\LogResource\Pages;

use App\Filament\Resources\LogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListLogs extends ListRecords
{
    protected static string $resource = LogResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Kullanıcı')
                    ->default('Sistem'),
                TextColumn::make('loggable_type')
                    ->label('Loggable Type'),
                TextColumn::make('log.type')
                    ->label('Log Tipi'),
                TextColumn::make('created_at')
                    ->label('Tarih')
                    ->datetime(),
            ]);
    }
}
