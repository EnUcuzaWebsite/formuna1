<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaveResource\Pages;
use App\Models\SavedPost;
use Filament\Resources\Resource;

class SaveResource extends Resource
{
    protected static ?string $model = SavedPost::class;

    protected static ?string $navigationLabel = 'Kaydetmeler';

    protected static ?int $navigationSort = 8;

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.saves.*')
            ? 'heroicon-s-bookmark'
            : 'heroicon-o-bookmark';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSaves::route('/'),
            //            'create' => Pages\CreateSave::route('/create'),
            //            'view' => Pages\ViewSave::route('/{record}'),
            //            'edit' => Pages\EditSave::route('/{record}/edit'),
        ];
    }
}
