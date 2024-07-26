<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            'is_featured' => fake()->randomElement([0, 1]),
            'content' => fake()->paragraph(50),
            'status' => Status::PUBLISHED,
            'category_id' => Category::factory(),
            'user_id' => User::factory()
        ];
    }
}
