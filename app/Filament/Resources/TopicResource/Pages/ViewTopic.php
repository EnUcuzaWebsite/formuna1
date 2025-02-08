<?php

namespace App\Filament\Resources\TopicResource\Pages;

use App\Filament\Resources\TopicResource;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewTopic extends ViewRecord
{
    protected static string $resource = TopicResource::class;


    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return $this->record->name;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(3)
            ->schema([
                Fieldset::make('Konu Bilgileri')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Başlık'),
                        TextEntry::make('slug')
                            ->label('Slug')
                            ->prefix('/'),
                        TextEntry::make('created_at')
                            ->label('Oluşturulma Tarihi')
                            ->date(),
                        TextEntry::make('detail')
                            ->label('Açıklama')
                            ->columnSpan(2),
                        TextEntry::make('category.name')
                            ->label('Kategori')
                            ->url(fn() => route('filament.admin.resources.categories.view', $this->record->category))
                            ->extraAttributes(['class' => 'view-url']),
                    ]),

                Section::make('Son Gönderilen Postlar')
                    ->collapsible()
                    ->hidden(fn () => $this->record->posts()->count() === 0)
                    ->schema([
                        RepeatableEntry::make('latest_posts')
                            ->hiddenLabel()
                            ->columns(2)
                            ->columnSpanFull()
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Başlık')
                                    ->columnSpanFull(),
                                TextEntry::make('user.name')
                                    ->label('Gönderen'),
                                TextEntry::make('created_at')
                                    ->label('Oluşturulma Tarihi')
                                    ->date(),
                                Actions::make([
                                    Action::make('view')
                                        ->label('Görüntüle')
                                        ->icon('heroicon-o-eye')
                                        ->url(fn($record) => route('filament.admin.resources.posts.view', $record)),
                                ])
                            ]),
                    ]),




            ]);
    }


}
