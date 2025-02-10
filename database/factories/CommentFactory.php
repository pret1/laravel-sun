<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::inRandomOrder()->first()->id,
            'content' => fake()->text(),
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'status' => fake()->boolean(),
        ];
    }

    private function getCommentId(): ?int
    {
        $countComments = Comment::count();
        if($countComments <= 2) {
            return null;
        }

        return Comment::inRandomOrder()->first()->id;
    }
}
