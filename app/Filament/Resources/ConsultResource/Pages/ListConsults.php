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
                ->badge(function(){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return Consult::count();
                    }

                    return Consult::where('receiver_id', auth()->id())->count();
                })
                ->badgeColor('info'),
            __('With Booking Date') => Tab::make()
                ->icon('heroicon-m-calendar-days')
                ->badge(function(){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return Consult::withDate()->count();
                    }

                    return Consult::withDate()->where('receiver_id',auth()->id())->count();
                })
                ->badgeColor('success')
                ->modifyQueryUsing(function(Builder $query){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return $query->withDate();
                    }
                    return $query->withDate()->where('receiver_id', auth()->id());
                }),
            __('Without Booking Date') => Tab::make()
                ->icon('heroicon-m-calendar')
                ->badge(function(){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return Consult::withoutDate()->count();
                    }

                    return Consult::withoutDate()->where('receiver_id', auth()->id())->count();
                })
                ->badgeColor('danger')
                ->modifyQueryUsing(function(Builder $query){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return $query->withoutDate();
                    }

                    return $query->withoutDate()->where('receiver_id',auth()->id());
                })
        ];
    }
}
