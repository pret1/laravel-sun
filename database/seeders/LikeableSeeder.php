<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Database\Factories\LikeableFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LikeableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
//    public function run(): void
//    {
//        LikeableFactory::new()->count(50)->create();
//    }

    public function run(): void
    {
        $likeableTypes = [Post::class, Comment::class, Article::class];

        for ($i = 0; $i < 50; $i++) {
            $likeableType = $likeableTypes[array_rand($likeableTypes)];

            DB::table('likeables')->insert([
                'likeable_id' => $likeableType::inRandomOrder()->first()->id,
                'likeable_type' => $likeableType,
                'profile_id' => Profile::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
