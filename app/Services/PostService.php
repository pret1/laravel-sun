<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public static function store(array $data): Post
    {

        $imagePath = $data['post']['image_path'] ?? null;
        unset($data['post']['image_path']);

        $post = Post::create($data['post']);
        $tagIds = TagService::storeBatch($data['tags']);
        $post->tags()->attach($tagIds);

        if ($imagePath) {
            $post->image()->create(['image_path' => $imagePath]);
        }

        return $post;
    }
}
