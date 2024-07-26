<?php

namespace App\Filament\App\Resources\ListingResource\Pages;

use App\Filament\App\Resources\ListingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditListing extends EditRecord
{
    protected static string $resource = ListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
