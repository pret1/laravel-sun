<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public static function store(array $data): Post
    {

        $post = Post::create($data['post']);
        $tagIds = TagService::storeBatch($data['tags']);
        $post->tags()->attach($tagIds);

        if ($data['image_paths']) {
            foreach ($data['image_paths'] as $image) {
                $post->image()->create(['image_path' => $image]);
            }
        }

        return $post;
    }
}
