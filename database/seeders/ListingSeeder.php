<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = ['New', 'Used'];
        $engines = ['Normal', 'Turb', 'Supercharged', 'Hybric', 'Electric'];
        $drives = ['AWD/4WD', 'Front Wheel Drive', 'Rear Wheel Drive'];
        $listedbys = ['I am a registered dealer', 'I am a private seller'];
        $types = ['Convertible', 'Coupe', 'Hatchback', 'Sedan', 'SUV', 'Wagon'];
        $fuels = ['Diesel', 'Electric', 'Hybrid', 'Petrol'];
        $offerstypes = ['Sold', 'Selling'];
        $transmissions = ['Automatic', 'Manual', 'Semi-Automatic'];

        //Condition
        foreach ($conditions as $c) {
            Models\Condition::create([
                'name' => $c
            ]);
        }
        //Engine
        foreach ($engines as $c) {
            Models\Engine::create([
                'name' => $c
            ]);
        }
        //DriveType
        foreach ($drives as $c) {
            Models\DriveType::create([
                'name' => $c
            ]);
        }
        //Listedbys
        foreach ($listedbys as $c) {
            Models\ListedBy::create([
                'name' => $c
            ]);
        }
        //Types
        foreach ($types as $c) {
            Models\Type::create([
                'name' => $c
            ]);
        }
        //Fuel
        foreach ($fuels as $c) {
            Models\FuelType::create([
                'name' => $c
            ]);
        }
        //Offerstypes
        foreach ($offerstypes as $c) {
            Models\OfferType::create([
                'name' => $c
            ]);
        }
        //Transmissions
        foreach ($transmissions as $c) {
            Models\Transmission::create([
                'name' => $c
            ]);
        }

        Models\Currency::create([
            'name' => 'U.S. Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'format' => '$1,0.00',
            'exchange_rate' => 1.00000000,
            'active' => 1,
        ]);

        Models\Currency::create([
            'name' => 'EURO',
            'code' => 'EUR',
            'symbol' => '€',
            'format' => '€1,0.00',
            'exchange_rate' => 1.00000000,
            'active' => 1,
        ]);
        $features = collect([
            'Adjustable Steering Wheel', 'Auto-Dimming Rearview Mirror', 'Driver Adjustable Lumbar',
            'Driver Illuminated Vanity Mirror', 'Universal Garage Door Opener', 'Steering Wheel Audio Controls',
            'Heated Front Seats', 'Leather Seats', 'Leather Steering Wheel', 'Pass-Through Rear Seat',
            'Passenger Adjustable Lumbar', 'Passenger Illuminated Visor Mirror', 'Alloy Wheels',
            'Sunroof / Moonroof', 'Tinged Glass', 'LED Headlights', 'Foldable Roof', 'Tow Hitch',
            'Multi-Zone A/C', 'Climate Control', 'Navigation System', 'Remote Start', 'Bluetooth',
            'Apple CarPlay', 'Android Auto', 'Backup Camera', 'HomeLink', 'Keyless Start',
            'Premium Sound System', 'Brake Assist', 'Lane Departure Warning', 'Stability Control',
            'Fog Lights', 'Power Door Locks', 'Airbag: Driver', 'Airbag: Passenger',
            'Adaptive Cruise Control', 'Blind Spot Monitor', 'Alarm', 'Antilock Brakes'
        ]);

        $features->each(fn ($f) => Models\Feature::create(['name' => $f, 'type' => rand(0, 2)]));

        $colors = collect([
            'Red', 'Blue', 'Green', 'Yellow', 'Orange', 'Purple', 'Pink', 'Brown', 'Black',
            'White', 'Gray', 'Cyan', 'Magenta', 'Maroon', 'Navy', 'Teal', 'Lime', 'Olive',
            'Indigo', 'Beige'
        ]);

        $colors->each(fn ($c) => Models\Color::create(['name' => $c]));

        // Models\Condition::factory(2)->create();
        // Models\Engine::factory(5)->create();
        // Models\Color::factory(10)->create();
        // Models\DriveType::factory(6)->create();
        // Models\Feature::factory(20)->create();
        // Models\ListedBy::factory(2)->create();
        // Models\Type::factory(5)->create();
        // Models\Make::factory(10)->has(
        //     Models\MakeModel::factory()->count(5),
        //     'makemodels'
        // )->create();
        // Models\FuelType::factory(10)->create();
        // Models\OfferType::factory(3)->create();
        // Models\Transmission::factory(5)->create();
        // Models\Currency::factory(2)->create();
        // Models\Listing::factory(3)->create();
        //Models\Post::factory(30)->create();
    }
}
