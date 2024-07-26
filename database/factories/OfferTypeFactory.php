<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfferType>
 */
class OfferTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Sold', 'Selling', 'Presale']),
            'display_as_label' => fake()->randomElement([true, false]),
            'card_label_text_color' => fake()->hexColor(),
            'card_label_background_color' => fake()->hexColor()
        ];
    }
}
