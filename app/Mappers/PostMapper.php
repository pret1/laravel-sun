<?php

namespace App\Mappers;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;

class PostMapper
{

    public static function getEdit(Post $post): array
    {
        return [
            'post' => PostResource::make($post)->resolve(),
            'categories' => CategoryResource::collection(Category::all())->resolve()
        ];
    }
}
