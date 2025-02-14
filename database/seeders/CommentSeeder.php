<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory()->count(10)->create();

        $comments = Comment::all();
        foreach ($comments as $comment) {
            if($comment->id > 3) {
                do {
                    $randomComment = Comment::inRandomOrder()->first();
                } while ($randomComment->id === $comment->id);

                $comment->update(['parent_id' => $randomComment->id]);
            }
        }
    }
}
