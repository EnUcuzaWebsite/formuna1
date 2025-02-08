<?php

namespace App\Filament\Resources\SaveResource\Pages;

use App\Filament\Resources\SaveResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSave extends ViewRecord
{
    protected static string $resource = SaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
