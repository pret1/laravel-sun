<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PostException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Post\StoreRequest;
use Illuminate\Http\Response;
use \App\Http\Filter\PostFilter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        $posts = Post::filter($data)->get();

        return PostResource::collection($posts)->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $post = PostService::store($data);
        return PostResource::make($post)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
//        $title = 'Test dasdasdasdyjjjt';
//
//        $post = Post::firstOrCreate([
//            'title' => $title,
//        ], [
//            'content' => 'This is a test post',
//            'is_published' => true,
//            'published_at' => now(),
//            'category_id' => '1',
//            'profile_id' => '1',
//        ]);
//
//        PostException::ifPostExists($post);

        return PostResource::make($post)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);
        return PostResource::make($post)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response('success deleted', 200);
    }
}
