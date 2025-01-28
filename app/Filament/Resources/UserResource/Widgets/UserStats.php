<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Filament\Resources\UserResource\Pages\ListUsers;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListUsers::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', $this->getPageTableQuery()->count())
                ->icon('heroicon-o-user-group'),

            Stat::make('Suspended Users', $this->getPageTableQuery()->whereHas('suspensions', function ($query) {
                $query->where('status', 'suspended');
            })->count())
                ->icon('heroicon-o-clock'),

            Stat::make('Banned Users', $this->getPageTableQuery()->whereHas('suspensions', function ($query) {
                $query->where('status', 'banned');
            })->count())
                ->icon('heroicon-o-no-symbol'),

        ];
    }
}
