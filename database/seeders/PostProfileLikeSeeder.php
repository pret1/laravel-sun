<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostProfileLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();
        $posts = Post::all();

        if ($profiles->isEmpty() || $posts->isEmpty()) {
            return;
        }

        foreach ($profiles as $profile) {
            $likedPosts = $posts->random(rand(1, 5));
            $profile->likedPosts()->attach($likedPosts->pluck('id'));
        }
    }
}
