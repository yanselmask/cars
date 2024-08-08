<?php

namespace App\Observers;

use App\Events\ListingWasCreated;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class ListingObserver
{
    /**
     * Handle the Listing "created" event.
     */
    public function created(Listing $listing): void
    {
        $user = auth()->user();

        if($user && $listing->user_id == $user->id) {
            event(new ListingWasCreated($user,$listing));
        }

        if (!$listing->user_id) {
            $listing->forceFill([
                'user_id' => $user->id,
            ])->save();
        }

        if($listing->user_id) {
            $owner = User::find($listing->user_id);
            notificationFilament()
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view')
                        ->label(__('View listing'))
                        ->button()
                        ->url(route('listing.show', $listing->getRouteKey()))
                ])
            ->success()
            ->title(__('New listing added'))
            ->body(__(':owner has added a new listing', ['owner' => $owner->full_name]))
            ->sendToDatabase($owner->followers);
        }

        if (config('listing.billing') == 'chargePerSeat') {
            $user->addSeat();
        }
    }

    /**
     * Handle the Listing "updated" event.
     */
    public function updated(Listing $listing): void
    {
        if (!auth()->user()) {
            return;
        }

        if (!auth()->user()->isSuperAdmin()) {
            if (($listing->status == \App\Enums\ListingStatus::APPROVED || $listing->status == \App\Enums\ListingStatus::REJECTED)) {
                $listing->forceFill([
                    'status' => \App\Enums\ListingStatus::PENDING
                ])->save();
            }
        }

        Cache::flush();
    }

    /**
     * Handle the Listing "deleted" event.
     */
    public function deleted(Listing $listing): void
    {
        if (config('listing.billing') == 'chargePerSeat') {
            auth()->user()->removeSeat();
        }

        Cache::flush();
    }

    /**
     * Handle the Listing "restored" event.
     */
    public function restored(Listing $listing): void
    {
        //
    }

    /**
     * Handle the Listing "force deleted" event.
     */
    public function forceDeleted(Listing $listing): void
    {
        //
    }
}
