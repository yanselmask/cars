<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feature>
 */
class FeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Adjustable Steering Wheel', 'Auto-Dimming Rearview Mirror', 'Driver Adjustable Lumbar', 'Driver Illuminated Vanity Mirror', 'Universal Garage Door Opener', 'Steering Wheel Audio Controls', 'Heated Front Seats', 'Leather Seats', 'Leather Steering Wheel', 'Pass-Through Rear Seat', 'Passenger Adjustable Lumbar', 'Passenger Illuminated Visor Mirror', 'Alloy Wheels', 'Sunroof / Moonroof', 'Tinged glass', 'LED Headlights', 'Foldable Roof', 'Tow Hitch', 'Multi-Zone A/C', 'Climate Control', 'Navigation System', 'Remote Start', 'Bluetooth', 'Apple CarPlay', 'Android Auto', 'Backup Camera', 'HomeLink', 'Keyless Start', 'Premium Sound System', 'Brake Assist', 'Lane Departure Warning', 'Stability Control', 'Fog Lights', 'Power Door Locks', 'Airbag: Driver', 'Airbag: Passenger', 'Adaptive Cruise Control', 'Blind Spot Monitor', 'Alarm', 'Antilock Brakes']),
            'type' => fake()->randomElement([0, 1, 2])
        ];
    }
}
