<?php

namespace App\Filament\Resources;

use App\Enums\ListingStatus;
use App\Filament\App\Resources\ListingResource\Widgets\CreditStat;
use App\Filament\Resources\ListingResource\Pages;
use App\Filament\Resources\ListingResource\RelationManagers;
use App\Models\Listing;
use ArberMustafa\FilamentLocationPickrField\Forms\Components\LocationPickr;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use App\Filament\Custom\SEO;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Listings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        $passengers = collect(range(1, config('listing.passengers_qty')))
            ->mapWithKeys(function ($item) {
                return [$item => $item];
            })
            ->all();
        $doors = collect(range(1, config('listing.doors_qty')))
            ->mapWithKeys(function ($item) {
                return [$item => $item];
            })
            ->all();
        $cylinders = collect(range(1, config('listing.cylinders_qty')))
            ->mapWithKeys(function ($item) {
                return [$item => $item];
            })
            ->all();
        $years = collect(range(config('listing.years_from'), config('listing.years_to')))
            ->mapWithKeys(function ($item) {
                return [$item => $item];
            })
            ->all();

        return $form
            ->schema([

                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make(__('Basic Information'))
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required(),
                                    Forms\Components\TextInput::make('slug')
                                        ->prefix(config('app.url') . '/' . config('listing.path_listing') . '/'),
                                ]),
                            Forms\Components\Radio::make('listedby_id')
                                ->label(__('Listed By'))
                                ->options(\App\Models\ListedBy::select('name', 'id')->get()->mapWithKeys(fn ($listed) => [$listed->id => $listed->name]))
                                ->descriptions(\App\Models\ListedBy::select('description', 'id')->get()->mapWithKeys(fn ($listed) => [$listed->id => $listed->description]))
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Radio::make('is_featured')
                                ->label(__('Featured'))
                                ->options(fn (): array => match (auth()->user()->canFeatureListing()) {
                                    true => [
                                        false => __('No'),
                                        true => __('Yes')
                                    ],
                                    false => [
                                        false => __('No')
                                    ],
                                })
                                ->inline()
                                ->inlineLabel(false)
                                ->visible(!auth()->user()->isSuperAdmin())
                                ->columnSpanFull()
                        ]),
                    Forms\Components\Wizard\Step::make(__('General data'))
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('make_id')
                                        ->label(__('Make'))
                                        ->live()
                                        ->searchable()
                                        ->relationship(name: 'make', titleAttribute: 'name')
                                        ->required(),
                                    Forms\Components\Select::make('makemodel_id')
                                        ->label(__('Model'))
                                        ->options(fn (Get $get): array => \App\Models\MakeModel::select('name', 'id')->where('make_id', $get('make_id'))->get()->mapWithKeys(fn ($model) => [$model->id => $model->name])->toArray())
                                        ->disabled(fn (Get $get) => $get('make_id') == null)
                                        ->required(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('type_id')
                                        ->label(__('Type'))
                                        ->relationship(name: 'type', titleAttribute: 'name')
                                        ->required(),
                                    Forms\Components\Select::make('condition_id')
                                        ->label(__('Condition'))
                                        ->relationship(name: 'condition', titleAttribute: 'name')
                                        ->required(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('year')
                                        ->options($years)
                                        ->required(),
                                    Forms\Components\TextInput::make('vin'),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('mileage_type')
                                        ->options(\App\Enums\MileageType::labels())
                                        ->required(),
                                    Forms\Components\TextInput::make('mileage')
                                        ->numeric()
                                        ->required(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('exterior_color_id')
                                        ->label(__('Exterior'))
                                        ->relationship(name: 'exteriorcolor', titleAttribute: 'name')
                                        ->required(),
                                    Forms\Components\Select::make('interior_color_id')
                                        ->label(__('Interior'))
                                        ->relationship(name: 'interiorcolor', titleAttribute: 'name')
                                        ->required(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('doors')
                                        ->label(__('Doors'))
                                        ->options($doors),
                                    Forms\Components\Select::make('passengers')
                                        ->label(__('Passengers'))
                                        ->options($passengers),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('charge_type')
                                        ->label(__('Charge Type'))
                                        ->options(\App\Enums\ChargeType::labels()),
                                    Forms\Components\TextInput::make('charge')
                                        ->label(__('Charge'))
                                        ->numeric(),
                                ]),
                            Forms\Components\RichEditor::make('content')
                                ->label(__('Content'))
                        ]),
                    Forms\Components\Wizard\Step::make(__('Technical data'))
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('fueltype_id')
                                        ->label(__('Fuel'))
                                        ->relationship(name: 'fueltype', titleAttribute: 'name')
                                        ->required(),
                                    Forms\Components\Select::make('offertype_id')
                                        ->label(__('Offer Type'))
                                        ->relationship(name: 'offertype', titleAttribute: 'name')
                                        ->required(),
                                ]),
                            Forms\Components\Grid::make(3)
                                ->schema([
                                    Forms\Components\Select::make('cylinders')
                                        ->label(__('Cylinders'))
                                        ->options($cylinders)
                                        ->required(),
                                    Forms\Components\TextInput::make('engine_cc')
                                        ->label(__('Engine'))
                                        ->numeric()
                                        ->suffix('L'),
                                    Forms\Components\Select::make('engine_id')
                                        ->label(__('Engine'))
                                        ->relationship(name: 'engine', titleAttribute: 'name')
                                        ->required(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('drivetype_id')
                                        ->label(__('Drive Type'))
                                        ->relationship(name: 'drivetype', titleAttribute: 'name')
                                        ->required(),
                                    Forms\Components\Select::make('transmission_id')
                                        ->label(__('Transmission'))
                                        ->relationship(name: 'transmission', titleAttribute: 'name')
                                        ->required(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('city_mpg')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('highway_mpg')
                                        ->numeric(),
                                ])
                        ]),
                    Forms\Components\Wizard\Step::make(__('Gallery'))
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('gallery')
                                ->label(__('Gallery'))
                                ->collection('gallery')
                                ->multiple()
                                ->reorderable(),
                            Forms\Components\TextInput::make('video_link'),
                        ]),
                    Forms\Components\Wizard\Step::make(__('Location'))
                        ->schema([
                            LocationPickr::make('location')
                                ->mapControls([
                                    'mapTypeControl'    => true,
                                    'scaleControl'      => true,
                                    'streetViewControl' => true,
                                    'rotateControl'     => true,
                                    'fullscreenControl' => true,
                                    'zoomControl'       => false,
                                ])
                                ->defaultZoom(5)
                                ->draggable()
                                ->clickable()
                                ->height('60vh')
                                ->myLocationButtonLabel(__('My location')),
                        ]),
                    Forms\Components\Wizard\Step::make(__('Features'))
                        ->schema([
                            Forms\Components\Placeholder::make(__('Exterior')),
                            Forms\Components\CheckboxList::make('exterior')
                                ->hiddenLabel()
                                ->relationship(
                                    name: 'features',
                                    titleAttribute: 'name',
                                    modifyQueryUsing: fn (Builder $query) => $query->where('type', \App\Enums\FeatureType::EXTERIOR)
                                )
                                ->columns(3),
                            Forms\Components\Placeholder::make(__('Interior')),
                            Forms\Components\CheckboxList::make('interior')
                                ->hiddenLabel()
                                ->relationship(
                                    name: 'features',
                                    titleAttribute: 'name',
                                    modifyQueryUsing: fn (Builder $query) => $query->where('type', \App\Enums\FeatureType::INTERIOR)
                                )
                                ->columns(3),
                            Forms\Components\Placeholder::make(__('Safety')),
                            Forms\Components\CheckboxList::make('safety')
                                ->hiddenLabel()
                                ->relationship(
                                    name: 'features',
                                    titleAttribute: 'name',
                                    modifyQueryUsing: fn (Builder $query) => $query->where('type', \App\Enums\FeatureType::SAFETY)
                                )
                                ->columns(3),
                        ]),
                    Forms\Components\Wizard\Step::make(__('Price'))
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('currency_id')
                                        ->relationship(name: 'currency', titleAttribute: 'symbol')
                                        ->required(),
                                    Forms\Components\TextInput::make('price')
                                        ->mask(RawJs::make('$money($input)'))
                                        ->stripCharacters(',')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\Checkbox::make('is_negotiated')
                                ])
                        ]),
                ])->columnSpanFull(),
                Forms\Components\Section::make([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->options(ListingStatus::class)
                                ->visible(auth()->user()->isSuperAdmin()),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->default(auth()->user()->id)
                        ]),
                    Forms\Components\Grid::make(4)
                        ->schema([
                            Forms\Components\Radio::make('is_featured')
                                ->label(__('Featured'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin()),
                            Forms\Components\Radio::make('is_mileage_verified')
                                ->label(__('Mileage verified'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin()),
                            Forms\Components\Radio::make('is_city_mpg_verified')
                                ->label(__('City Mpg Verified'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin()),
                            Forms\Components\Radio::make('is_highway_mpg_verified')
                                ->label(__('Highway Mpg Verified'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin())
                        ]),
                    Forms\Components\Fieldset::make(__('Badges'))
                        ->schema([
                            Forms\Components\Radio::make('is_certified')
                                ->label(__('Checked and Certified'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin()),
                            Forms\Components\Radio::make('is_single_owner')
                                ->label(__('Single Owner'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin()),
                            Forms\Components\Radio::make('is_well_equipped')
                                ->label(__('Well-Equipped'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin()),
                            Forms\Components\Radio::make('no_accident')
                                ->label(__('No Accident / Damage Reported'))
                                ->boolean()
                                ->visible(auth()->user()->isSuperAdmin()),
                        ])
                        ->visible(auth()->user()->isSuperAdmin())
                        ->columns(4)
                ])
                    ->visible(
                        auth()->user()->isSuperAdmin()
                    ),
                SEO::make()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('listedby.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('make.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('makemodel.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('condition.name')
                    ->searchable(),
                Tables\Columns\CheckboxColumn::make('is_featured')
                    ->visible(auth()->user()->isSuperAdmin()),
                Tables\Columns\TextColumn::make('fueltype.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('offertype.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency.symbol'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (!auth()->user()->isSuperAdmin()) {
                    return $query->where('user_id', auth()->id());
                }

                return $query->orderByDesc('created_at');
            })
            ->filters([
                Filters\Filter::make('is_featured')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true)),
                Filters\Filter::make('is_certified')
                    ->query(fn (Builder $query): Builder => $query->where('is_certified', true)),
                Filters\Filter::make('is_single_owner')
                    ->query(fn (Builder $query): Builder => $query->where('is_single_owner', true)),
                Filters\Filter::make('is_well_equipped')
                    ->query(fn (Builder $query): Builder => $query->where('is_well_equipped', true)),
                Filters\Filter::make('no_accident')
                    ->query(fn (Builder $query): Builder => $query->where('no_accident', true)),
                Filters\SelectFilter::make('status')
                    ->options(ListingStatus::class),
                Filters\SelectFilter::make('condition')
                    ->relationship('condition', 'name'),
                Filters\SelectFilter::make('make')
                    ->relationship('make', 'name'),
                Filters\SelectFilter::make('drivetype')
                    ->relationship('drivetype', 'name'),
                Filters\SelectFilter::make('type')
                    ->relationship('type', 'name'),
                Filters\SelectFilter::make('fueltype')
                    ->relationship('fueltype', 'name'),
                Filters\SelectFilter::make('transmission')
                    ->relationship('transmission', 'name'),
                Filters\SelectFilter::make('interiorcolor')
                    ->relationship('interiorcolor', 'name'),
                Filters\SelectFilter::make('exteriorcolor')
                    ->relationship('exteriorcolor', 'name'),
                Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
