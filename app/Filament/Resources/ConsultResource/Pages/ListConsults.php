<?php

namespace App\Filament\Resources\ConsultResource\Pages;

use App\Filament\Resources\ConsultResource;
use App\Models\Consult;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
class ListConsults extends ListRecords
{
    protected static string $resource = ConsultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }


    public function getTabs(): array
    {
        return [
            __('All') => Tab::make()
                ->icon('heroicon-m-envelope')
                ->badge(fn() => Consult::where('receiver_id', auth()->id())->count())
                ->badgeColor('info'),
            __('With Booking Date') => Tab::make()
                ->icon('heroicon-m-calendar-days')
                ->badge(fn() => Consult::where('receiver_id', auth()->id())->withDate()->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->withDate()),
            __('Without Booking Date') => Tab::make()
                ->icon('heroicon-m-calendar')
                ->badge(fn() => Consult::where('receiver_id', auth()->id())->withoutDate()->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->withoutDate())
        ];
    }
}
