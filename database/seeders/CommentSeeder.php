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
        Comment::factory()->count(100)->create();

        $comments = Comment::all();
        foreach ($comments as $comment) {
            if($comment->id > 30 && !$comment->parent_id && !$comment->childrenComments()->exists()) {
                $randomParent = Comment::where('commentable_type', $comment->commentable_type)
                    ->where('id', '!=', $comment->id)
                    ->inRandomOrder()
                    ->first();

                if($randomParent) {
                    $comment->update(['parent_id' => $randomParent->id]);
                }
            }
        }
    }
}
