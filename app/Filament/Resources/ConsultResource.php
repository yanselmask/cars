<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultResource\Pages;
use App\Filament\Resources\ConsultResource\RelationManagers;
use App\Models\Consult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultResource extends Resource
{
    protected static ?string $model = Consult::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Listings';

    protected static ?int $navigationSort  = 15;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([])
            ->modifyQueryUsing(function ($query) {
                if (!auth()->user()->isSuperAdmin()) {
                    $query->where('receiver_id', auth()->id());
                }
            })
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
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
            'index' => Pages\ListConsults::route('/'),
            'create' => Pages\CreateConsult::route('/create'),
            'view' => Pages\ViewConsult::route('/{record}'),
            'edit' => Pages\EditConsult::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('fullname'),
                        Infolists\Components\TextEntry::make('email'),
                    ]),
                Infolists\Components\Grid::make(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('phone'),
                        Infolists\Components\TextEntry::make('message')
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
