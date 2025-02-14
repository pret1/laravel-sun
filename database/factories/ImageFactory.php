<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageableType = $this->faker->randomElement([Post::class, Comment::class]);
        $imageableId = $imageableType::inRandomOrder()->first()?->id;

        return [
            'imageable_id' => $imageableId,
            'imageable_type' => $imageableType,
        ];
    }
}
