<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LikedPostResource\Pages;
use App\Filament\Resources\LikedPostResource\RelationManagers;
use App\Models\LikedPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LikedPostResource extends Resource
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
            'index' => Pages\ListLikedPosts::route('/'),
            // 'create' => Pages\CreateLikedPost::route('/create'),
            // 'edit' => Pages\EditLikedPost::route('/{record}/edit'),
        ];
    }
}
