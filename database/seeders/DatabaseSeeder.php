<?php

namespace Database\Seeders;

use App\Models;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!file_exists(storage_path('./installed'))) {
            $this->call(ListingSeeder::class);
            $this->call(InstallerSeeder::class);
            $this->call(InstallMenuDefaultSeeder::class);
        }
    }
}
