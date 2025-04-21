<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Post\StoreChildCommentRequest;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Resources\Comment\Client\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Inertia\Response;

class PostController extends Controller
{
    public function show(Post $post): Response
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Client/Post/Show', compact('post'));
    }

    public function toggleLike(Post $post): JsonResponse
    {
        $res = $post->likedProfiles()->toggle(auth()->user()->profile->id);
        $likedProfilesCount = $post->likedProfiles()->count();
        return response()->json([
            'is_liked' => count($res['attached']) > 0,
            'liked_profiles_count' => $likedProfilesCount,
        ]);
    }

    public function indexComments(Post $post): array
    {
        return CommentResource::collection(
            $post->comments()->whereNull('parent_id')->latest()->get()
        )->resolve();
    }

    public function storeComments(StoreCommentRequest $request, Post $post): array
    {
        $data = $request->validationData();

        $comment = $post->comments()->create($data);

        return CommentResource::make($comment)->resolve();
    }

    public function storeChildComments(StoreChildCommentRequest $request, Post $post, Comment $comment): array
    {
        $data = $request->validationData();

        $childComments = $post->comments()->create($data);

        return CommentResource::make($childComments)->resolve();
    }


    public function indexChildComments(Post $post, Comment $comment): array
    {
        $childComments = $comment->childrenComments()->latest()->get();
        return CommentResource::collection($childComments)->resolve();
    }
}
