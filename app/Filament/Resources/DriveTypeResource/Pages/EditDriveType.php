<?php

namespace App\Filament\Resources\DriveTypeResource\Pages;

use App\Filament\Resources\DriveTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDriveType extends EditRecord
{
    protected static string $resource = DriveTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
