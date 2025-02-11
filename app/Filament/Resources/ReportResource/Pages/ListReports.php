<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use App\Models\Post;
use App\Models\Report;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->sortable()
                    ->default('Sistem'),
                TextColumn::make('reportable_id'),
                TextColumn::make('report.type')
                    ->label('Şikayet Tipi')
                    ->searchable()
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
                    ->modalCancelAction(false)
                    ->modalSubmitAction(false)
                    ->successRedirectUrl(function ($record) {
                        if ($record->report['type'] === 'user report') {
                            route('filament.admin.resources.users.view', ['record' => $record->reportable_id]);
                        } elseif ($record->report['type'] === 'post report') {
                            route('filament.admin.resources.posts.view', ['record' => $record->reportable_id]);
                        }
                    })
                    ->modalHeading('Şikayet')
                    ->infolist([
                        TextEntry::make('report.message')
                            ->html()
                            ->suffixAction(
                                \Filament\Infolists\Components\Actions\Action::make('process')
                                    ->label('process')
                                    ->icon('heroicon-o-eye')
                                    ->url(fn (Report $record): string => $record->report['type'] === 'user report' ? route('filament.admin.resources.users.view', ['record' => $record->reportable_id]) : route('filament.admin.resources.posts.view', ['record' => $record->reportable_id]))
                                )
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
            ])
            ->filters([
                SelectFilter::make('report.type')
                    ->label('Şikayet Tipi')
                    ->native(false)
                    ->options([
                        'user report' => 'User Report',
                        'post report' => 'Post Report',
                    ])
                    ->query(function ($query, $data) {
                        if ($data['value']) {
                            $query->where('report->type', $data['value']);
                        }
                    }),
            ]);
    }
}
