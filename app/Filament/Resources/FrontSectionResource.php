<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FrontSectionResource\Pages;
use App\Filament\Resources\FrontSectionResource\RelationManagers;
use App\Models\FrontSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FrontSectionResource extends Resource
{
    protected static ?string $model = FrontSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('key')
                            ->required(),
                    ]),
                Forms\Components\Section::make([

                    Forms\Components\Builder::make('data_values')
                        ->blocks([
                            Forms\Components\Builder\Block::make('homepage_hero')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Textarea::make('description'),
                                    Forms\Components\FileUpload::make('image'),
                                ]),
                            Forms\Components\Builder\Block::make('types')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Select::make('types')
                                        ->multiple()
                                        ->options(\App\Models\Type::select('name', 'id')->get()->mapWithKeys(fn ($type) => [$type->id => $type->name]))
                                ]),
                            Forms\Components\Builder\Block::make('offers')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Select::make('listings')
                                        ->multiple()
                                        ->maxItems(3)
                                        ->options(\App\Models\Listing::approved()
                                            ->OwnerHasSubscriptionActived()
                                            ->select('name', 'id')
                                            ->get()->mapWithKeys(fn ($type) => [$type->id => $type->name]))
                                ]),
                            Forms\Components\Builder\Block::make('brands')
                                ->schema([
                                    Forms\Components\Select::make('brands')
                                        ->multiple()
                                        ->options(\App\Models\Make::select('name', 'id')->get()->mapWithKeys(fn ($make) => [$make->id => $make->name])),
                                ]),
                            Forms\Components\Builder\Block::make('features')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\TextInput::make('btn_text'),
                                    Forms\Components\TextInput::make('btn_link')
                                        ->default('#'),
                                    Forms\Components\Select::make('btn_target')
                                        ->options([
                                            '_self' => __('Self'),
                                            '_blank' => __('Blank'),
                                        ])
                                        ->default('_self'),
                                    Forms\Components\Repeater::make('list')
                                        ->schema([
                                            Forms\Components\TextInput::make('icon'),
                                            Forms\Components\TextInput::make('title'),
                                            Forms\Components\Textarea::make('description'),
                                        ])
                                        ->cloneable()
                                        ->maxItems(6)
                                ]),
                            Forms\Components\Builder\Block::make('listing')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Checkbox::make('is_featured'),
                                    Forms\Components\Checkbox::make('is_certified'),
                                    Forms\Components\Checkbox::make('is_negotiated'),
                                    Forms\Components\Checkbox::make('is_single_owner'),
                                    Forms\Components\Checkbox::make('is_well_equipped'),
                                    Forms\Components\Checkbox::make('no_accident'),
                                    Forms\Components\TextInput::make('limit')
                                        ->numeric()
                                        ->default(6)
                                        ->required(),
                                ]),
                            Forms\Components\Builder\Block::make('carousel')
                                ->schema([
                                    Forms\Components\Repeater::make('grids')
                                        ->schema([
                                            Forms\Components\TextInput::make('title'),
                                            Forms\Components\Textarea::make('description'),
                                            Forms\Components\TextInput::make('btn_text'),
                                            Forms\Components\Select::make('btn_target')
                                                ->options([
                                                    '_self' => __('Self'),
                                                    '_blank' => __('Blank'),
                                                ])
                                                ->default('_self'),
                                            Forms\Components\TextInput::make('btn_link')
                                                ->default('#'),
                                            Forms\Components\Select::make('btn_color')
                                                ->options([
                                                    'primary' => __('Primary'),
                                                    'secondary' => __('Secondary'),
                                                    'info' => __('Info'),
                                                    'warning' => __('Warning'),
                                                    'danger' => __('Danger'),
                                                    'success' => __('Success'),
                                                ])
                                                ->default('primary'),
                                            Forms\Components\Repeater::make('products')
                                                ->schema([
                                                    Forms\Components\TextInput::make('title'),
                                                    Forms\Components\FileUpload::make('image'),
                                                    Forms\Components\TextInput::make('link')
                                                        ->default('#'),
                                                ])
                                                ->maxItems(4)
                                        ])
                                        ->cloneable()
                                        ->maxItems(6)
                                ]),
                            Forms\Components\Builder\Block::make('app_mobile')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Textarea::make('description'),
                                    Forms\Components\TextInput::make('app_store_link')
                                        ->default('#'),
                                    Forms\Components\TextInput::make('google_play_link')
                                        ->default('#'),
                                    Forms\Components\FileUpload::make('image'),
                                ]),
                            Forms\Components\Builder\Block::make('blog')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\TextInput::make('limit')
                                        ->numeric()
                                        ->required(),
                                ]),
                            Forms\Components\Builder\Block::make('about_us')
                                ->schema([
                                    Forms\Components\FileUpload::make('image'),
                                    Forms\Components\TextInput::make('title')
                                        ->required(),
                                    Forms\Components\Textarea::make('description'),
                                    Forms\Components\TextInput::make('btn_text'),
                                    Forms\Components\Select::make('btn_target')
                                        ->options([
                                            '_self' => __('Self'),
                                            '_blank' => __('Blank'),
                                        ])
                                        ->default('_self'),
                                    Forms\Components\TextInput::make('btn_link')
                                        ->default('#'),
                                    Forms\Components\Select::make('btn_color')
                                        ->options([
                                            'primary' => __('Primary'),
                                            'secondary' => __('Secondary'),
                                            'info' => __('Info'),
                                            'warning' => __('Warning'),
                                            'danger' => __('Danger'),
                                            'success' => __('Success'),
                                        ])
                                        ->default('primary'),
                                ]),
                            Forms\Components\Builder\Block::make('list_grid_card')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Repeater::make('cards')
                                        ->schema([
                                            Forms\Components\FileUpload::make('image'),
                                            Forms\Components\TextInput::make('title'),
                                            Forms\Components\Textarea::make('description')
                                        ])
                                        ->cloneable()
                                        ->maxItems(3)
                                ]),
                            Forms\Components\Builder\Block::make('our_story')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Repeater::make('cards')
                                        ->schema([
                                            Forms\Components\TextInput::make('title'),
                                            Forms\Components\Textarea::make('description')
                                        ])
                                        ->cloneable()
                                        ->maxItems(5)
                                ]),
                            Forms\Components\Builder\Block::make('card_image')
                                ->schema([
                                    Forms\Components\FileUpload::make('image'),
                                    Forms\Components\Select::make('image_position')
                                        ->options([
                                            'left' => __('Left'),
                                            'right' => __('Right'),
                                        ])
                                        ->default('left'),
                                    Forms\Components\TextInput::make('title')
                                        ->required(),
                                    Forms\Components\Textarea::make('description'),
                                    Forms\Components\TextInput::make('btn_text'),
                                    Forms\Components\Select::make('btn_target')
                                        ->options([
                                            '_self' => __('Self'),
                                            '_blank' => __('Blank'),
                                        ])
                                        ->default('_self'),
                                    Forms\Components\TextInput::make('btn_link')
                                        ->default('#'),
                                    Forms\Components\Select::make('btn_color')
                                        ->options([
                                            'primary' => __('Primary'),
                                            'secondary' => __('Secondary'),
                                            'info' => __('Info'),
                                            'warning' => __('Warning'),
                                            'danger' => __('Danger'),
                                            'success' => __('Success'),
                                        ])
                                        ->default('primary'),
                                ]),
                            Forms\Components\Builder\Block::make('partners')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Repeater::make('partners')
                                        ->schema([
                                            Forms\Components\FileUpload::make('image')
                                                ->required(),
                                            Forms\Components\TextInput::make('link')
                                                ->default('#'),
                                        ])
                                        ->cloneable()
                                        ->maxItems(10)
                                ]),
                            Forms\Components\Builder\Block::make('faq')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Textarea::make('description'),
                                    Forms\Components\TextInput::make('btn_text'),
                                    Forms\Components\Select::make('btn_target')
                                        ->options([
                                            '_self' => __('Self'),
                                            '_blank' => __('Blank'),
                                        ])
                                        ->default('_self'),
                                    Forms\Components\TextInput::make('btn_link')
                                        ->default('#'),
                                    Forms\Components\Select::make('btn_color')
                                        ->options([
                                            'primary' => __('Primary'),
                                            'secondary' => __('Secondary'),
                                            'info' => __('Info'),
                                            'warning' => __('Warning'),
                                            'danger' => __('Danger'),
                                            'success' => __('Success'),
                                        ])
                                        ->default('primary'),
                                    Forms\Components\FileUpload::make('image'),
                                    Forms\Components\Repeater::make('faqs')
                                        ->schema([
                                            Forms\Components\TextInput::make('title')
                                                ->required(),
                                            Forms\Components\Textarea::make('description'),
                                            Forms\Components\Checkbox::make('is_open')
                                        ])
                                        ->cloneable()
                                        ->maxItems(10)
                                ]),
                            Forms\Components\Builder\Block::make('contact_us')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Textarea::make('description'),
                                    Forms\Components\Repeater::make('list')
                                        ->schema([
                                            Forms\Components\FileUpload::make('icon'),
                                            Forms\Components\TextInput::make('title'),
                                            Forms\Components\Textarea::make('description'),
                                        ])
                                        ->cloneable()
                                        ->maxItems(3)
                                ]),
                            Forms\Components\Builder\Block::make('map')
                                ->schema([
                                    Forms\Components\TextInput::make('lat'),
                                    Forms\Components\TextInput::make('long'),
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Textarea::make('description'),
                                ]),
                            Forms\Components\Builder\Block::make('plans')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                ]),
                        ])
                        ->maxItems(1)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('key')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFrontSections::route('/'),
            'create' => Pages\CreateFrontSection::route('/create'),
            'edit' => Pages\EditFrontSection::route('/{record}/edit'),
        ];
    }
}
