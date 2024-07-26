<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakeModelResource\Pages;
use App\Filament\Resources\MakeModelResource\RelationManagers;
use App\Models\MakeModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MakeModelResource extends Resource
{
    protected static ?string $model = MakeModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationGroup = 'Listings';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('slug'),
                Forms\Components\Select::make('make_id')
                    ->relationship(name: 'make', titleAttribute: 'name'),
                Forms\Components\Textarea::make('description')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('make.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at')
            ])
            ->filters([
                SelectFilter::make('make')
                    ->relationship('make', 'name'),
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
            'index' => Pages\ListMakeModels::route('/'),
            'create' => Pages\CreateMakeModel::route('/create'),
            'edit' => Pages\EditMakeModel::route('/{record}/edit'),
        ];
    }
}
