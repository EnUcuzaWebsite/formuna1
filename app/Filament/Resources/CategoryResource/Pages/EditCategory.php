<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

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
                Textarea::make('detail')
                    ->label('Açıklama')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
