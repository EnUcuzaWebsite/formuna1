<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationLabel = 'Yorumlar';

    protected static ?int $navigationSort = 5;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.comments.*')
            ? 'heroicon-s-chat-bubble-left-right'
            : 'heroicon-o-chat-bubble-left-right';
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewComment::class,
            Pages\EditComment::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'view' => Pages\ViewComment::route('/{record}'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
