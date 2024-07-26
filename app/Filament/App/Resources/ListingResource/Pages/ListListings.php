<?php

namespace App\Filament\App\Resources\ListingResource\Pages;

use App\Filament\App\Resources\ListingResource;
use App\Filament\App\Resources\ListingResource\Widgets\CreditStat;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListings extends ListRecords
{
    protected static string $resource = ListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
