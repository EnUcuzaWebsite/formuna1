<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LikeResource\Pages;
use App\Models\LikedPost;
use Filament\Resources\Resource;

class LikeResource extends Resource
{
    protected static ?string $model = LikedPost::class;

    protected static ?string $navigationLabel = 'Beğenmeler';

    protected static ?int $navigationSort = 7;

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.likes.*')
            ? 'heroicon-s-heart'
            : 'heroicon-o-heart';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLikes::route('/'),
            //            'create' => Pages\CreateLike::route('/create'),
            //            'view' => Pages\ViewLike::route('/{record}'),
            //            'edit' => Pages\EditLike::route('/{record}/edit'),
        ];
    }
}
