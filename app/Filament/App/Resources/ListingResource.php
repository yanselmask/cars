<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ListingResource\Pages;
use App\Filament\App\Resources\ListingResource\RelationManagers;
use App\Filament\Resources\ListingResource as ResourcesListingResource;
use App\Models\Listing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ListingResource extends ResourcesListingResource
{
    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = '';

    protected static ?int $navigationSort = 1;
}
