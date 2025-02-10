<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Actions;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

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
                    ->searchable()
                    ->default('Sistem'),
                TextColumn::make('reportable_id'),
                TextColumn::make('report.type')
                    ->label('Şikayet Tipi')
                    ->sortable(),
                TextColumn::make('report.reason')
                    ->label('Neden')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Tarih')
                    ->datetime(),
            ])
            ->actions([
                Action::make('view')
                    ->hiddenLabel()
                    ->icon('heroicon-o-eye')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalHeading('Şikayet')
                    ->infolist([
                        TextEntry::make('report.message')
                            ->html()
                            ->label('Mesaj'),
                        TextEntry::make('report.reason')
                            ->columnSpanFull()
                            ->extraAttributes([
                                'class' => 'h-full w-full overflow-scroll',
                            ])
                            ->label('Neden')
                            ->html(),
                        TextEntry::make('report.type')
                            ->label('Şikayet Tipi'),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->label('Tarih'),
                    ])
            ]);
    }
}
