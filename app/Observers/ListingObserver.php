<?php

namespace App\Observers;

use App\Models\Listing;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ListingObserver
{
    /**
     * Handle the Listing "created" event.
     */
    public function created(Listing $listing): void
    {
        $user = auth()->user();

        if (isset($listing->location['lat']) && isset($listing->location['lng'])) {
            $url =
                'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $listing->location['lat'] . ',' . $listing->location['lng'] . '&key=' . env('GMAP_API');
            $response = Http::get($url);
            $data = $response->json();
            if ($data['status'] == 'OK') {
                foreach ($data['results'][0]['address_components'] as $component) {
                    if (in_array('locality', $component['types'])) {
                        $listing->city = $component['long_name'];
                    }
                    if (in_array('postal_code', $component['types'])) {
                        $listing->zip = $component['long_name'];
                    }
                }
                $listing->save();
            }
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
