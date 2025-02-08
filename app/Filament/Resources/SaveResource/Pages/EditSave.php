<?php

namespace App\Filament\Resources\SaveResource\Pages;

use App\Filament\Resources\SaveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSave extends EditRecord
{
    protected static string $resource = SaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
