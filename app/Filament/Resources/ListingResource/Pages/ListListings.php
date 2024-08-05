<?php

namespace App\Filament\Resources\ListingResource\Pages;

use App\Filament\Resources\ListingResource;
use App\Models\Listing;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListListings extends ListRecords
{
    protected static string $resource = ListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        if(auth()->user()->listings()->count() == 0)
        {
            return [];
        }

        return [
            __('All') => Tab::make()
                ->badge(function(){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return Listing::query()->count();
                    }
                    return Listing::query()->where('user_id',auth()->id())->count();
                })
                ->badgeColor('info'),
            __('Approved') => Tab::make()
                ->badge(function(){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return Listing::query()->Approved()->count();
                    }
                    return Listing::query()->where('user_id',auth()->id())->Approved()->count();
                })
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->Approved()),
            __('Pending') => Tab::make()
                ->badge(function(){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return Listing::query()->Pending()->count();
                    }
                    return Listing::query()->where('user_id',auth()->id())->Pending()->count();
                })
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->Pending()),
            __('Rejects') => Tab::make()
                ->badge(function(){
                    if(auth()->user()->isSuperAdmin())
                    {
                        return Listing::query()->Rejected()->count();
                    }
                    return Listing::query()->where('user_id',auth()->id())->Rejected()->count();
                })
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->Rejected()),
        ];
    }
}
