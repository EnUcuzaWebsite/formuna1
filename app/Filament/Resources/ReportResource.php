<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationLabel = 'Şikayetler';

    protected static ?int $navigationSort = 10;

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.reports.*')
            ? 'heroicon-s-exclamation-circle'
            : 'heroicon-o-exclamation-circle';
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
//            'view' => Pages\ViewReport::route('/{record}'),
//            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
