<?php

namespace App\Console\Commands;

use App\Models\Make;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\ListingSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SeederListing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'With this command you will fill the seeders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $seeder = new DatabaseSeeder();
        $seeder->call(
            ListingSeeder::class
        );
        if (config('listing.auto_dev_api')) {
            $url = 'https://auto.dev/api/models?apikey=' . config('listing.auto_dev_api');
            $request = Http::get($url);
            $data = $request->json();

            $bar = $this->output->createProgressBar(count($data));

            foreach ($data as $k => $m) {
                $make = Make::create([
                    'name' => $k
                ]);
                foreach ($m as $kt) {
                    $make->makemodels()->create(['name' => $kt]);
                }
                $bar->advance();
            }

            $bar->finish();
        }
    }
}
