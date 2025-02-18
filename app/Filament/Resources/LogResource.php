<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogResource\Pages;
use App\Models\Log;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LogResource extends Resource
{
    protected static ?string $model = Log::class;

    protected static ?string $navigationLabel = 'Loglar';

    protected static ?string $navigationGroup = 'Loglar';

    protected static ?int $navigationSort = 9;

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.logs.*')
            ? 'heroicon-s-finger-print'
            : 'heroicon-o-finger-print';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLogs::route('/'),
            'create' => Pages\CreateLog::route('/create'),
//            'view' => Pages\ViewLog::route('/{record}'),
//            'edit' => Pages\EditLog::route('/{record}/edit'),
        ];
    }
}
