<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ViewAbleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $viewableType = $this->faker->randomElement([Post::class, Comment::class, Article::class]);
        $viewableId = $viewableType::inRandomOrder()->first()?->id ?? $viewableType::factory()->create()->id;

        return [
            'viewable_id' => $viewableId,
            'viewable_type' => $viewableType,
            'profile_id' => Profile::inRandomOrder()->first()?->id ?? Profile::factory()->create()->id,
        ];
    }
}
