<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return $this->record->name;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(5)
            ->schema([
                SpatieMediaLibraryImageEntry::make('avatar')
                    ->hiddenLabel()
                    ->extraAttributes(['class' => 'h-full flex items-center justify-center'])
                    ->circular()
                    ->columnSpan(2)
                    ->defaultImageUrl($this->record->getFilamentAvatarUrl())
                    ->size(200),

                Fieldset::make('Overview')
                    ->columnSpan(3)
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('roles.name')
                            ->label('Roles')
                            ->bulleted()
                            ->listWithLineBreaks(),
                        IconEntry::make('status')
                            ->icon(fn(string $state): string => match ($state) {
                                'active' => 'heroicon-o-check-circle',
                                'inactive' => 'heroicon-o-x-circle',
                            })
                            ->color(fn(string $state): string => match ($state) {
                                'active' => 'success',
                                'inactive' => 'danger',
                                default => 'gray',
                            }),
                    ]),

                Fieldset::make('Biography')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('bio')
                            ->hiddenLabel()
                            ->columnSpan(3),
                    ]),

                RepeatableEntry::make('user_logs')
                    ->label('Loglar')
                    ->columnSpan(3)
                    ->hidden(fn() => $this->record->user_logs->isEmpty())
                    ->extraAttributes([
                        'class' => 'user-activiy',
                    ])
                    ->schema([
                        TextEntry::make('loggable_type')
                            ->label('İşlem'),
                        TextEntry::make('created_at')
                            ->label('Tarih')
                            ->datetime(),
                        TextEntry::make('log.message')
                            ->html()
                            ->hiddenLabel()
                            ->columnSpan(2),

                        RepeatableEntry::make('changes')
                            ->label('Değişiklikler')
                            ->hiddenLabel()
                            ->columnSpan(3)
                            ->columns(3)
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
                    ->columns(2),

            ]);
    }
}
