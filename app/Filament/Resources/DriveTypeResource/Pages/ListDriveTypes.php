<?php

namespace App\Filament\Resources\DriveTypeResource\Pages;

use App\Filament\Resources\DriveTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDriveTypes extends ListRecords
{
    protected static string $resource = DriveTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
