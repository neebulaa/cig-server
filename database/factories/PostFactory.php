<?php

namespace Database\Factories;

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
            "category_id" => random_int(1, 5),
            "title" => fake()->sentence(random_int(5, 10)),
            "slug" => fake()->slug(),
            "description" => fake()->sentences(random_int(2,4), true)
        ];
    }
}
