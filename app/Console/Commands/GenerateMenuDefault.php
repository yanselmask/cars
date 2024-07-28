<?php

namespace App\Console\Commands;

use Database\Seeders\DatabaseSeeder;
use Database\Seeders\InstallMenuDefaultSeeder;
use Database\Seeders\ListingSeeder;
use Illuminate\Console\Command;

class GenerateMenuDefault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:generate-menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate menu for default';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $seeder = new InstallMenuDefaultSeeder();
        $seeder->run();
        $this->info('Menu default created successfully!');
    }
}
