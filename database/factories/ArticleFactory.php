<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'content' => fake()->sentence(),
            'is_published' => fake()->boolean,
            'published_at' => fake()->dateTime,
            'category_id' => Category::inRandomOrder()->first()->id,
            'profile_id' => Profile::inRandomOrder()->first()->id,
        ];
    }
}
