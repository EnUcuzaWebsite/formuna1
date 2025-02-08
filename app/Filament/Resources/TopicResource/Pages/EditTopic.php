<?php

namespace App\Filament\Resources\TopicResource\Pages;

use App\Filament\Resources\TopicResource;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditTopic extends EditRecord
{
    protected static string $resource = TopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('İsim')
                    ->suffixIcon('heroicon-o-square-2-stack')
                    ->required(),
                TextInput::make('slug')
                    ->prefix('/')
                    ->label('Slug')
                    ->suffixIcon('heroicon-m-globe-alt')
                    ->required(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->suffixIcon('heroicon-o-tag')
                    ->options(
                        fn() => \App\Models\Category::all()->pluck('name', 'id')
                    )
                    ->required(),
                Textarea::make('detail')
                    ->label('Açıklama')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
