<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with([
            'profile',
            'tags',
            'category',
            'likedProfiles',
            'viewedProfiles',
            'profile.subscribers',
            'profile.subscribering',
            'image'
        ])->get();
        $posts = PostResource::collection($posts)->resolve();
        return inertia('Client/Dashboard/Index', compact('posts'));
    }
}
