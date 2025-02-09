<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewComment extends ViewRecord
{
    protected static string $resource = CommentResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Group::make()
                    ->columns(2)
                    ->extraAttributes(['class' => 'border-r-2 border-gray-300 h-full w-full '])
                    ->schema([
                        TextEntry::make('user.name')
                            ->url(fn () => route('filament.admin.resources.users.view', [$this->record->user]))
                            ->label('Kullanıcı'),
                        TextEntry::make('created_at')
                            ->label('Tarih'),

                        TextEntry::make('post.category.name')
                            ->label('Kategori')
                            ->url(fn () => route('filament.admin.resources.topics.view', $this->record->post->category))
                            ->extraAttributes(['class' => 'view-url']),

                        TextEntry::make('post.topic.name')
                            ->label('Konu')
                            ->url(fn () => route('filament.admin.resources.topics.view', $this->record->post->topic))
                            ->extraAttributes(['class' => 'view-url']),

                    ]),

                Group::make()
                    ->schema([
                        TextEntry::make('post.title')
                            ->hintAction(
                                Action::make('view')
                                    ->hiddenLabel()
                                    ->icon('heroicon-o-eye')
                                    ->size('w-full')
                                    ->url(fn () => route('filament.admin.resources.posts.view', [$this->record->post]))
                            )
                            ->label('Post'),
                        TextEntry::make('comment')
                            ->html()
                            ->label('Yorum'),

                    ]),
            ]);

    }
}
