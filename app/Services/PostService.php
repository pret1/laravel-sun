<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public static function store(array $data): Post
    {

        $imagePath = $data['image_path'] ?? null;
        unset($data['image_path']);

        $post = Post::create($data);

        if ($post && $imagePath) {
            $post->image()->create(['image_path' => $imagePath]);
        }

        return $post;
    }
}
