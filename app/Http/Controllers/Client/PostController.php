<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Resources\Comment\Client\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Mail\Comment\StoredCommentMail;
use App\Mail\Like\LikeMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Response;

class PostController extends Controller
{
    public function show(Post $post): Response
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Client/Post/Show', compact('post'));
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json([
            'message' => 'Post has been deleted.'
        ]);
    }

    public function toggleLike(Post $post): JsonResponse
    {
        $res = $post->likedProfiles()->toggle(auth()->user()->profile->id);
        $likedProfilesCount = $post->likedProfiles()->count();
        $isLiked = count($res['attached']) > 0;
        Mail::to($post->user)->send(new LikeMail($post, $isLiked));
        return response()->json([
            'is_liked' => count($res['attached']) > 0,
            'liked_profiles_count' => $likedProfilesCount,
        ]);
    }

    public function toggleLikeComment(Comment $comment): JsonResponse
    {
        $res = $comment->likedProfiles()->toggle(auth()->user()->profile->id);
        $isLiked = count($res['attached']) > 0;
        Mail::to($comment->user)->send(new LikeMail($comment, $isLiked));
        return response()->json([
            'is_liked' => $isLiked,
        ]);
    }

    public function indexComments(Post $post): array
    {
        return CommentResource::collection(
            $post->comments()->whereNull('parent_id')->latest()->get()
        )->resolve();
    }

    public function storeComments(StoreCommentRequest $request, Post $post, ?Comment $comment = null): array
    {
        $data = $request->validationData();

        $commentModel = $post->comments()->create($data);

        Mail::to($post->user)->send(
            new StoredCommentMail(
                $comment ?? $commentModel,
                $comment ? $commentModel : null
            )
        );

        return CommentResource::make($commentModel)->resolve();
    }


    public function indexChildComments(Comment $comment): array
    {
        $childComments = $comment->childrenComments()->latest()->get();
        return CommentResource::collection($childComments)->resolve();
    }
}
