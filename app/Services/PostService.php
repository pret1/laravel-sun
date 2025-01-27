<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public static function store(array $data): Post
    {
        return Post::create($data);
    }
}
