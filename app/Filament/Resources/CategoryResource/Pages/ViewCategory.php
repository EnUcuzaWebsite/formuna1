<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;


class ViewCategory extends ViewRecord
{
    protected static string $resource = CategoryResource::class;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return $this->record->name;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Fieldset::make('Kategori Bilgileri')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label('İsim'),
                        TextEntry::make('slug')
                            ->label('Slug')
                            ->prefix('/'),
                        TextEntry::make('created_at')
                            ->label('Oluşturulma Tarihi')
                            ->date(),
                        TextEntry::make('detail')
                            ->label('Açıklama')
                            ->columnSpanFull(),
                        TextEntry::make('post_count')
                            ->getStateUsing(fn() => $this->record->posts()->count())
                            ->label('Post Sayısı')
                            ->columnSpanFull(),
                    ]),

                Section::make('Son Gönderilen Postlar')
                    ->collapsible()
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
