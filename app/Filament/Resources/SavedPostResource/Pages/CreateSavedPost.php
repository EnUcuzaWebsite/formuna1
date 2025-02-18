<?php

namespace App\Filament\Resources\SavedPostResource\Pages;

use App\Filament\Resources\SavedPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSavedPost extends CreateRecord
{
    protected static string $resource = SavedPostResource::class;
}
