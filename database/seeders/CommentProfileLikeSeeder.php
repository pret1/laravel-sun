<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentProfileLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();
        $comments = Comment::all();

        if ($profiles->isEmpty() || $comments->isEmpty()) {
            return;
        }

        foreach ($profiles as $profile) {
            $likedComments = $comments->random(rand(5, 8));
            $profile->likedComments()->toggle($likedComments->pluck('id'));
        }
    }
}
