<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('listing:seller-no-subscribed', function(){
        \App\Models\Listing::query()
            ->OwnerDontHaveSubscriptionActived()
            ->where('status', \App\Enums\ListingStatus::APPROVED)
            ->chunk(200, function ($listings){
                foreach ($listings as $listing){
                    $listing->status = \App\Enums\ListingStatus::EXPIRATED;
                    $listing->save();
                }
            });
})->everyFiveMinutes();
Schedule::command('listing:removing-feature-past')
    ->everyMinute();
