<?php

namespace App\Filament\Resources\ListedByResource\Pages;

use App\Filament\Resources\ListedByResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListedBies extends ListRecords
{
    protected static string $resource = ListedByResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
