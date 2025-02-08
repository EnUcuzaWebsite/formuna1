<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FollowResource\Pages;
use App\Filament\Resources\FollowResource\RelationManagers;
use App\Models\Follow;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FollowResource extends Resource
{
    protected static ?string $model = Follow::class;

    protected static ?string $navigationLabel = 'Takipler';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.follows.*')
            ? 'heroicon-s-user-plus'
            : 'heroicon-o-user-plus';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFollows::route('/'),
//            'create' => Pages\CreateFollow::route('/create'),
//            'view' => Pages\ViewFollow::route('/{record}'),
//            'edit' => Pages\EditFollow::route('/{record}/edit'),
        ];
    }
}
