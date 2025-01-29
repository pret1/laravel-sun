<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\StoreRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CommentResource::collection(Comment::all())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $post = CommentService::store($data);
        return CommentResource::make($post)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $post)
    {
        return CommentResource::make($post)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $post)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $post)
    {
        //
    }
}
