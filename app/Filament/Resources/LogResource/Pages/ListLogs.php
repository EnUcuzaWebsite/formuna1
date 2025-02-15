<?php

namespace App\Filament\Resources\LogResource\Pages;

use App\Filament\Resources\LogResource;
use Filament\Actions;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->searchable()
                    ->sortable()
                    ->default('Sistem'),
                TextColumn::make('loggable_type')
                    ->searchable()
                    ->sortable()
                    ->label('Loggable Type'),
                TextColumn::make('log.type')
                    ->searchable()
                    ->sortable()
                    ->label('Log Tipi'),
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
                    ->modalHeading('Log')
                    ->infolist([
                        TextEntry::make('log.message')
                            ->columnSpanFull()
                            ->label('Mesaj')
                            ->html(),
                        TextEntry::make('log.type')
                            ->label('Log Tipi'),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->label('Tarih'),
                        RepeatableEntry::make('changes')
                            ->label('Değişiklikler')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('field')
                                    ->suffix(':')
                                    ->weight('bold')
                                    ->hiddenLabel(),
                                TextEntry::make('old')
                                    ->label('Eski'),
                                TextEntry::make('new')
                                    ->label('Yeni'),
                            ]),
                    ])
            ])
            ->filters([
                SelectFilter::make('log.type')
                    ->label('Log Tipi')
                    ->native(false)
                    ->options([
                        'like' => 'Beğenme',
                        'unlike' => 'Beğeni Kaldırma',
                        'save' => 'Kaydetme',
                        'unsave' => 'Kaydetme Kaldırma',
                        'follow' => 'Takip',
                        'unfollow' => 'Takipten Çıkarma',
                        'updated' => 'Güncelleme',
                        'created' => 'Oluşturma',
                        'active post' => 'Post Aktif',
                        'inactive post' => 'Post İnaktif',
                        'suspended' => 'Kullanıcı Engel',
                        'banned' => 'Kullanıcı Ban',
                    ])
                    ->query(function ($query, $data) {
                        if ($data['value']) {
                            $query->where('log->type', $data['value']);
                        }
                    }),
            ]);
    }
}
