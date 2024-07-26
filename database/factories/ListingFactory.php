<?php

namespace Database\Factories;

use App\Models;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'condition_id' => Models\Condition::factory(),
            'type_id' => Models\Type::factory(),
            'make_id' => Models\Make::factory(),
            'makemodel_id' => Models\MakeModel::factory(),
            'drivetype_id' => Models\DriveType::factory(),
            'transmission_id' => Models\Transmission::factory(),
            'fueltype_id' => Models\FuelType::factory(),
            'engine_cc' => rand(10, 9999),
            'engine_id' => Models\Engine::factory(),
            'exterior_color_id' => Models\Color::factory(),
            'interior_color_id' => Models\Color::factory(),
            'offertype_id' => Models\OfferType::factory(),
            'listedby_id' => Models\ListedBy::factory(),
            'currency_id' => Models\Currency::factory(),
            'year' => rand(1950, 2025),
            'cylinders' => rand(1, 16),
            'vin' => fake()->sentence(1),
            'content' => fake()->paragraph(50),
            'video_link' => fake()->randomElement(['https://www.youtube.com/watch?v=L9_xKVwVkso', 'https://www.youtube.com/watch?v=qChhd2Rsx4A', 'https://www.youtube.com/watch?v=4Ic2hXWTaBk', 'https://www.youtube.com/watch?v=8QkGS1rSmG0']),
            'price' => rand(10000, 999999),
            'is_negotiated' => rand(0, 1),
            'is_certified' => rand(0, 1),
            'is_single_owner' => rand(0, 1),
            'is_well_equipped' => rand(0, 1),
            'is_city_mpg_verified' => rand(0, 1),
            'is_highway_mpg_verified' => rand(0, 1),
            'is_mileage_verified' => rand(0, 1),
            'no_accident' => rand(0, 1),
            'city_mpg' => rand(1000, 9999),
            'highway_mpg' => rand(1000, 9999),
            'doors' => rand(1, 50),
            'passengers' => rand(1, 16),
            'charge' => rand(0, 99999),
            'charge_type' => fake()->randomElement([\App\Enums\ChargeType::KILOGRAMS, \App\Enums\ChargeType::POUNDS]),
            'mileage' => rand(0, 99999),
            'mileage_type' => fake()->randomElement([\App\Enums\MileageType::HOURS, \App\Enums\MileageType::KILOMETRES, \App\Enums\MileageType::MILES]),
            'status' => fake()->randomElement([\App\Enums\ListingStatus::APPROVED, \App\Enums\ListingStatus::PENDING, \App\Enums\ListingStatus::REJECTED]),
            'user_id' => Models\User::factory()
        ];
    }
}
