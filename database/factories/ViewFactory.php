<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\View>
 */
class ViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $viewableType = $this->faker->randomElement([Post::class, Comment::class]);
        $viewableId = $viewableType::inRandomOrder()->first()?->id;

        return [
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'viewable_id' => $viewableId,
            'viewable_type' => $viewableType,
        ];
    }
}
