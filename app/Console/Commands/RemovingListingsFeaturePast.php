<?php

namespace App\Console\Commands;

use App\Models\Listing;
use Illuminate\Console\Command;

class RemovingListingsFeaturePast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:removing-feature-past';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will clear listings that are no longer featured.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \DB::transaction(function(){
            Listing::whereDate('featured_expirate','<=', now())
            ->chunk(200, function($listings) {
               foreach ($listings as $listing) {
                   $listing->featured_expirate = null;
                   $listing->is_featured = false;
                   $listing->save();
               }
            });
        });
    }
}
