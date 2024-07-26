<?php

namespace App\Filament\App\Resources\ConsultResource\Pages;

use App\Filament\App\Resources\ConsultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsult extends EditRecord
{
    protected static string $resource = ConsultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
