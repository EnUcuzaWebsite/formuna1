<?php

namespace App\Filament\Resources\SavedPostResource\Pages;

use App\Filament\Resources\SavedPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSavedPost extends EditRecord
{
    protected static string $resource = SavedPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
