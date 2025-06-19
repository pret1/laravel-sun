<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Events\UserNotification\SendWsNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Post\RepostRequest;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Resources\Comment\Client\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Jobs\Comment\StoredCommentSendMailJob;
use App\Jobs\Like\ToggleLikeMailJob;
use App\Models\Comment;
use App\Models\Post;
use App\Models\UserNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('delete', $post);
        $post->delete();
        return response()->json([
            'message' => 'Post has been deleted.'
        ]);
    }

    public function repost(RepostRequest $request, Post $post): array
    {
        $data = $request->validationData();
        $post = $post->repostedPosts()->create($data);
        return PostResource::make($post)->resolve();
    }

    public function indexReposts(Post $post): array
    {
        $posts = $post->repostedPosts()->get();
        return PostResource::collection($posts)->resolve();
    }

    public function toggleLike(Post $post): JsonResponse
    {
        $res = $post->likedProfiles()->toggle(auth()->user()->profile->id);
        $likedProfilesCount = $post->likedProfiles()->count();
        $isLiked = count($res['attached']) > 0;
        $userNotification = UserNotification::create([
            'user_id' => $post->user->id,
            'content' => 'Someone like or dislike your post.',
        ]);
//        event(new SendWsNotificationEvent($userNotification));
        SendWsNotificationEvent::dispatch($userNotification);
        ToggleLikeMailJob::dispatch($post, $isLiked);
        return response()->json([
            'is_liked' => count($res['attached']) > 0,
            'liked_profiles_count' => $likedProfilesCount,
        ]);
    }

    public function toggleLikeComment(Comment $comment): JsonResponse
    {
        $res = $comment->likedProfiles()->toggle(auth()->user()->profile->id);
        $isLiked = count($res['attached']) > 0;
        ToggleLikeMailJob::dispatch($comment, $isLiked);
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

        $newComment = $post->comments()->create($data);

        StoredCommentSendMailJob::dispatch($post, $newComment, $comment);

        return CommentResource::make($newComment)->resolve();
    }


    public function indexChildComments(Comment $comment): array
    {
        $childComments = $comment->childrenComments()->latest()->get();
        return CommentResource::collection($childComments)->resolve();
    }
}
