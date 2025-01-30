<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\StoreRequest;
use App\Http\Requests\Api\Comment\UpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use \Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return array
     */
    public function index(): array
    {
        return CommentResource::collection(Comment::all())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $post = CommentService::store($data);
        return CommentResource::make($post)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): array
    {
        return CommentResource::make($comment)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Comment $comment): Comment
    {
        $data = $request->validated();
        $comment->update($data);
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): ResponseFactory|Application|Response
    {
        $comment->delete();
        return response('success deleted ', 200);
    }
}
