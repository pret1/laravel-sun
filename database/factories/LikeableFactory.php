<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;


class LikeableFactory extends Factory
{

    //need check
    public function definition()
    {
        $likeableTypes = [
            Post::class,
            Comment::class,
        ];

        return [
            'likeable_id' => fn() => $likeableTypes[array_rand($likeableTypes)]::inRandomOrder()->first()->id,
            'likeable_type' => fn() => $likeableTypes[array_rand($likeableTypes)],
            'profile_id' => Profile::inRandomOrder()->first()->id,
        ];

//        return [
//            'likeable_id' => $this->getRandomLikeableId(),
//            'likeable_type' => $this->getRandomLikeableType(),
//            'profile_id' => Profile::inRandomOrder()->first()->id,
//        ];
    }

    private function getRandomLikeableType(): string
    {
        return $this->faker->randomElement([
            Post::class,
            Comment::class,
        ]);
    }

    private function getRandomLikeableId(): int
    {
        $model = $this->getRandomLikeableType();
        return $model::inRandomOrder()->first()->id ?? 1;
    }
}
