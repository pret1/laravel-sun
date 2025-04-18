<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
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
}
