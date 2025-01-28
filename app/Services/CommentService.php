<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public static function store(array $data)
    {
        return Comment::create($data);
    }
}
