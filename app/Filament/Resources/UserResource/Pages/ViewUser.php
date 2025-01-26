<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;


    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(3)
            ->schema([
                SpatieMediaLibraryImageEntry::make('avatar')
                    ->hiddenLabel()
                    ->extraAttributes(['class' => 'h-full flex items-center justify-center'])
                    ->circular()
                    ->columnSpan(1)
                    ->size(200),

                Fieldset::make('İfo')
                    ->columnSpan(2)
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
                                'suspended' => 'heroicon-o-clock',
                                'banned' => 'heroicon-o-no-symbol',
                            })
                            ->color(fn(string $state): string => match ($state) {
                                'active' => 'success',
                                'suspended' => 'warning',
                                'banned' => 'danger',
                                default => 'gray',
                            }),
                    ]),

            ]);
    }
}