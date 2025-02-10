<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    public function getHeaderActions(): array
    {
        return [
            Action::make('inactive')
                ->label($this->record->isactive() ? 'Engelle' : 'Aktifleştir' )
                ->icon($this->record->isactive() ? 'heroicon-o-exclamation-triangle' : 'heroicon-o-check-circle')
                ->form([
                    Textarea::make('reason')
                        ->label('Neden')
                ])
                ->color($this->record->isactive() ? 'danger' : 'success')
                ->requiresConfirmation()
                ->action(function (array $data) {


                    if ($this->record->isactive()){
                        $this->record->status = 'inactive';
                        $this->record->saveQuietly();
                        $this->record->log([
                            'type' => 'inactive post',
                            'message' => '<strong>
                                         <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                            '.auth()->user()->name.'
                                        </a>
                                        </strong>
                                      <small> '. $data['reason'] . ' nedeniyle Engelledi</small>
                                      <strong>
                                        <a href="'.route('filament.admin.resources.posts.view', ['record' => $this->record]).'">
                                            '.$this->record->id.' -> post
                                        </a>
                                      </strong>
                                       ',
                        ]);
                    }
                    else{
                        $this->record->status = 'active';
                        $this->record->saveQuietly();
                        $this->record->log([
                            'type' => 'active post',
                            'message' => '<strong>
                                         <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                            '.auth()->user()->name.'
                                        </a>
                                        </strong>
                                      <small> '. $data['reason'] . ' nedeniyle aktifleştirdi</small>
                                      <strong>
                                        <a href="'.route('filament.admin.resources.posts.view', ['record' => $this->record]).'">
                                            '.$this->record->id.' -> post
                                        </a>
                                      </strong>
                                       ',
                             ]);
                    }


                })
            ];


    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(2)
            ->schema([
                Fieldset::make('Detaylar')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Yazar'),
                        TextEntry::make('created_at')
                            ->label('Oluşturulma Tarihi')
                            ->date(),
                        TextEntry::make('status')
                            ->label('Durum')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'active' => 'success',
                                'inactive' => 'danger',
                            }),

                        TextEntry::make('category.name')
                            ->label('Kategori')
                            ->url(fn () => route('filament.admin.resources.categories.view', $this->record->category))
                            ->extraAttributes(['class' => 'view-url']),

                        TextEntry::make('topic.name')
                            ->label('Konu')
                            ->url(fn () => route('filament.admin.resources.topics.view', $this->record->topic))
                            ->extraAttributes(['class' => 'view-url']),

                        TextEntry::make('likes_count')
                            ->label('Beğeni Sayısı')
                            ->getStateUsing(fn () => $this->record->likes()->count()),
                        TextEntry::make('saves_count')
                            ->label('Kaydedilme Sayısı')
                            ->getStateUsing(fn () => $this->record->saves()->count()),
                        TextEntry::make('comments_count')
                            ->label('Yorum Sayısı')
                            ->getStateUsing(fn () => $this->record->comments()->count()),
                        TextEntry::make('reports_count')
                            ->label('Şikayet Sayısı')
                            ->getStateUsing(fn () => $this->record->reports()->count()),

                    ]),
                Fieldset::make('Başlık')
                    ->schema([
                        TextEntry::make('title')
                            ->hiddenLabel(),
                    ]),
                Fieldset::make('İçerik')
                    ->schema([
                        TextEntry::make('content')
                            ->columnSpanFull()
                            ->html()
                            ->hiddenLabel(),
                    ]),

                Section::make('Yorumlar')
                    ->columnSpan(2)
                    ->collapsible()
                    ->collapsed()
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->hidden(fn () => $this->record->comments()->count() === 0)
                    ->schema([
                        RepeatableEntry::make('comments')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->schema([
                                TextEntry::make('user.name')
                                    ->suffix(':')
                                    ->weight('bold')
                                    ->hiddenLabel(),
                                TextEntry::make('comment')
                                    ->prefix('"')
                                    ->suffix('"')
                                    ->hiddenLabel(),

                            ]),
                    ]),

                Section::make('Beğenenler')
                    ->columnSpan(1)
                    ->collapsible()
                    ->collapsed()
                    ->icon('heroicon-o-heart')
                    ->hidden(fn () => $this->record->likes()->count() === 0)
                    ->schema([
                        RepeatableEntry::make('likes')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->schema([
                                TextEntry::make('user.name')
                                    ->hiddenLabel()
                                    ->url(fn ($state, $record) => route('filament.admin.resources.users.view', $record->user->id)),
                            ]),

                    ]),
                Section::make('Kaydedenler')
                    ->columnSpan(1)
                    ->collapsible()
                    ->collapsed()
                    ->icon('heroicon-o-bookmark')
                    ->hidden(fn () => $this->record->saves()->count() === 0)
                    ->schema([
                        RepeatableEntry::make('saves')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->schema([
                                TextEntry::make('user.name')
                                    ->hiddenLabel(),

                            ]),

                    ]),
                Section::make('Şikayetler')
                    ->columnSpan(1)
                    ->collapsible()
                    ->collapsed()
                    ->icon('heroicon-o-bookmark')
                    ->hidden(fn () => $this->record->reports()->count() === 0)
                    ->schema([
                        RepeatableEntry::make('reports')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->schema([
                                TextEntry::make('user.name')
                                    ->hiddenLabel(),
                                TextEntry::make('report.reason')
                                    ->label('Neden'),
                            ]),

                    ]),

            ]);

    }
}
