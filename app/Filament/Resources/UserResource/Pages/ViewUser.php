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

    public function getHeaderActions(): array
    {
        return [

        ];
    }

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
                RepeatableEntry::make('activities')
                    ->label('Activities')
                    ->hidden(fn() => $this->record->activities->isEmpty())
                    ->extraAttributes([
                        'class' => 'user-activiy',
                    ])
                    ->columnSpan(3)
                    ->schema([
                        TextEntry::make('activity_type')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'report' => 'warning',
                                'follow' => 'info',
                            }),
                        TextEntry::make('target_user.name')
                            ->label('Target'),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->label('Date'),
                    ])
                    ->columns(3),

                RepeatableEntry::make('suspensions')
                    ->label('Suspensions')
                    ->hidden(fn() => $this->record->suspensions->isEmpty())
                    ->columnSpan(2)
                    ->extraAttributes([
                        'class' => 'user-suspensions',
                    ])
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'suspended' => 'warning',
                                'banned' => 'danger',
                            }),
                        TextEntry::make('reason'),
                        TextEntry::make('starts_at')
                            ->label('Start Date'),
                        TextEntry::make('expires_at')
                            ->label('End Date'),
                    ])
                    ->columns(2)

            ]);
    }
}
