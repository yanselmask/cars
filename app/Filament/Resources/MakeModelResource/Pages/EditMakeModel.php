<?php

namespace App\Filament\Resources\MakeModelResource\Pages;

use App\Filament\Resources\MakeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMakeModel extends EditRecord
{
    protected static string $resource = MakeModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
