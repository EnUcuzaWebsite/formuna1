<?php

namespace App\Filament\Resources\LikedPostResource\Pages;

use App\Filament\Resources\LikedPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLikedPost extends EditRecord
{
    protected static string $resource = LikedPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
