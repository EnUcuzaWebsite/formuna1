<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Postlar';

    protected static ?int $navigationSort = 2;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.posts.*')
            ? 'heroicon-s-document-text'
            : 'heroicon-o-document-text';
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewPost::class,
            Pages\EditPost::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
