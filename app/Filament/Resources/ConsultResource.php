<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultResource\Pages;
use App\Filament\Resources\ConsultResource\RelationManagers;
use App\Models\Consult;
use App\Models\Listing;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
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
                Tables\Columns\TextColumn::make('listing.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('booking_date')
                    ->label(__('Booking Date'))
                    ->searchable(),
                Tables\Columns\CheckboxColumn::make('read_at'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('read_at')
                    ->label(__('Read at'))
                    ->nullable()
                    ->placeholder(__('All'))
                    ->trueLabel(__('Read at'))
                    ->falseLabel(__('Dont read at'))
                    ->queries(
                        true: fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('read_at', true),
                        false: fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('read_at', false),
                        blank: fn (\Illuminate\Database\Eloquent\Builder $query) => $query,
                    )
            ])
            ->modifyQueryUsing(function ($query) {
                if (!auth()->user()->isSuperAdmin()) {
                    $query->where('receiver_id', auth()->id());
                }
                return $query->orderByDesc('created_at');
            })
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
                        Infolists\Components\TextEntry::make('fullname')
                            ->icon('heroicon-m-user-circle'),
                        Infolists\Components\TextEntry::make('email')
                            ->icon('heroicon-m-envelope'),
                    ]),
                Infolists\Components\Grid::make(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('phone')
                            ->icon('heroicon-m-phone')
                            ->visible(fn (Consult $consult) : bool => $consult->phone ? true : false),
                        Infolists\Components\TextEntry::make('booking_date')
                            ->dateTime()
                            ->icon('heroicon-m-calendar-days')
                            ->visible(fn (Consult $consult) : bool => $consult->booking_date ? true : false)
                    ])
                    ->visible(fn (Consult $consult) : bool => ($consult->phone || $consult->booking_date) ? true : false)
                    ->columnSpanFull(),
                 Infolists\Components\Grid::make(2)
                     ->schema([
                         Infolists\Components\TextEntry::make('listing.name')
                             ->label(__('Listing'))
                             ->icon('heroicon-m-truck')
                             ->url(fn (Consult $consult): string => route('listing.show', $consult->listing))
                            ->visible(fn (Consult $consult) : bool => $consult->listing_id ? true : false),
                         Infolists\Components\TextEntry::make('message')
                             ->icon('heroicon-m-envelope-open')
                     ])
                     ->columnSpanFull(),
            ]);
    }
}
