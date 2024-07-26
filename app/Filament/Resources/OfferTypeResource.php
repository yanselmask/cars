<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferTypeResource\Pages;
use App\Filament\Resources\OfferTypeResource\RelationManagers;
use App\Models\OfferType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferTypeResource extends Resource
{
    protected static ?string $model = OfferType::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Listings';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('slug'),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Checkbox::make('display_as_label'),
                        Forms\Components\ColorPicker::make('card_label_text_color'),
                        Forms\Components\ColorPicker::make('card_label_background_color'),
                    ]),
                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\ColorColumn::make('card_label_text_color'),
                Tables\Columns\ColorColumn::make('card_label_background_color'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListOfferTypes::route('/'),
            'create' => Pages\CreateOfferType::route('/create'),
            'edit' => Pages\EditOfferType::route('/{record}/edit'),
        ];
    }
}
