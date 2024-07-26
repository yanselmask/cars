<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ConsultResource\Pages;
use App\Filament\App\Resources\ConsultResource\RelationManagers;
use App\Filament\Resources\ConsultResource as ResourcesConsultResource;
use App\Models\Consult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultResource extends ResourcesConsultResource
{

    protected static ?string $navigationGroup = '';

    protected static ?int $navigationSort = 3;
}
