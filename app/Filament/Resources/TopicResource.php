<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopicResource\Pages;
use App\Models\Topic;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Konular';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.topics.*')
            ? 'heroicon-s-rectangle-group'
            : 'heroicon-o-rectangle-group';
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewTopic::class,
            Pages\EditTopic::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'view' => Pages\ViewTopic::route('/{record}'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
        ];
    }
}
