<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\VerticalAlignment;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Fieldset::make('Başlık')
                    ->schema([
                        TextEntry::make('title')
                            ->hiddenLabel(),
                    ]),
                Fieldset::make('İçerik')
                    ->schema([
                        TextEntry::make('content')
                            ->columnSpanFull()
                            ->hiddenLabel(),
                    ]),

                Fieldset::make('Detaylar')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Yazar'),
                        TextEntry::make('created_at')
                            ->label('Oluşturulma Tarihi')
                            ->date(),
                        TextEntry::make('category.name')
                            ->label('Kategori')
                            ->suffixAction(
                                Action::make('view')
                                    ->label('Görüntüle')
                                    ->icon('heroicon-o-eye')
                                    ->url(fn() => route('filament.admin.resources.categories.view', $this->record->category))
                            ),
                        TextEntry::make('topic.name')
                            ->label('Konu')
                            ->suffixAction(
                                Action::make('view')
                                    ->label('Görüntüle')
                                    ->icon('heroicon-o-eye')
                                    ->url(fn() => route('filament.admin.resources.topics.view', $this->record->topic))
                            ),
                        TextEntry::make('likes_count')
                            ->label('Beğeni Sayısı')
                            ->getStateUsing(fn() => $this->record->likes()->count()),
                        TextEntry::make('saves_count')
                            ->label('Kaydedilme Sayısı')
                            ->getStateUsing(fn() => $this->record->saves()->count())

                    ])
            ]);

    }

}
