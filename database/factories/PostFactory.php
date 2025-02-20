<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Profile;
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
            'title' => fake()->words(3, true),
            'content' => fake()->sentence(),
//            'content' => fake()->realTextBetween(300, 1255),
            'profile_id' => Profile::first()->id,
            'is_published' => fake()->boolean(),
//            'image_path' => fake()->imageUrl,
            'category_id' => Category::inRandomOrder()->first()->id,
//            'views' => fake()->numberBetween(0, 1000),
            'published_at' => fake()->dateTime(),
        ];
    }
}
