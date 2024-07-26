<?php

namespace App\Filament\App\Resources\ConsultResource\Pages;

use App\Filament\App\Resources\ConsultResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewConsult extends ViewRecord
{
    protected static string $resource = ConsultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
