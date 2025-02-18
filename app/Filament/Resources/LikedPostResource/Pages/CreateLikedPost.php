<?php

namespace App\Filament\Resources\LikedPostResource\Pages;

use App\Filament\Resources\LikedPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLikedPost extends CreateRecord
{
    protected static string $resource = LikedPostResource::class;
}
