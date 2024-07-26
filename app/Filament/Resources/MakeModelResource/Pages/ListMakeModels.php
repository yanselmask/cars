<?php

namespace App\Filament\Resources\MakeModelResource\Pages;

use App\Filament\Resources\MakeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMakeModels extends ListRecords
{
    protected static string $resource = MakeModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
