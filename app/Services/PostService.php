<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public static function store(array $data): Post
    {
        if($data['image_path']) {
           $imagePath = $data['image_path'];
           unset($data['image_path']);
        }

        $post = Post::create($data);

        if ($post) {
            $post->image()->create(['image_path' => $imagePath]);
        }

        return $post;
    }
}
