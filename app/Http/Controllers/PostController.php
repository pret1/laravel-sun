<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    public function index()
    {
        return $posts = Post::all();
    }

    public function store()
    {
         $post = [
            'title' => 'Command title',
            'content' => 'content command',
            'author' => 'author command',
            'is_published' => true,
            'likes' => 1,
            'image_path' => '/var/www/html/' . rand(0, 1000) . '/' . rand(0, 1000) .'/images/image.jpg',
            'tag' => 'tag command',
            'category' => 'category command',
            'views' => 1,
            'published_at' => '2025-01-23 16:38:27',
        ];

         return PostService::store($post);
    }

    public function show(Post $post)
    {
        return PostResource::make($post)->resolve();
    }

    public function update(Post $post)
    {
        $data = [
            'title' => 'update title',
        ];
        $post->update($data);
        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response([
            'message' => 'delete success',
        ], ResponseAlias::HTTP_OK);
    }

}
