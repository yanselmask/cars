<?php

namespace App\Filament\Resources\ListedByResource\Pages;

use App\Filament\Resources\ListedByResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditListedBy extends EditRecord
{
    protected static string $resource = ListedByResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
