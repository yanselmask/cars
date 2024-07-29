<?php

namespace App\Observers;

use App\Events\ListingWasCreated;
use App\Models\Listing;
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
