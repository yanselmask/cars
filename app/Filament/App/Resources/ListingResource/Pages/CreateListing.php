<?php

namespace App\Filament\App\Resources\ListingResource\Pages;

use App\Filament\App\Resources\ListingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateListing extends CreateRecord
{
    protected static string $resource = ListingResource::class;
}
