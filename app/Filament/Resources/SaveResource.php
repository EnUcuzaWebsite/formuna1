<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaveResource\Pages;
use App\Filament\Resources\SaveResource\RelationManagers;
use App\Models\Save;
use App\Models\SavedPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
