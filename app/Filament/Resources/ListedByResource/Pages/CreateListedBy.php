<?php

namespace App\Filament\Resources\ListedByResource\Pages;

use App\Filament\Resources\ListedByResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateListedBy extends CreateRecord
{
    protected static string $resource = ListedByResource::class;
}
