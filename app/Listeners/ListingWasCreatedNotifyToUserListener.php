<?php

namespace App\Listeners;

use App\Events\ListingWasCreated;
use App\Notifications\ListingWasCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListingWasCreatedNotifyToUserListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ListingWasCreated $event): void
    {
        $user = $event->listing->user;

        if($user)
        {
           $user->notify(new ListingWasCreatedNotification($event->listing));
        }
    }
}
