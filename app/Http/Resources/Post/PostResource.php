<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'is_published' => $this->is_published,
            'likes' => $this->likedProfiles->count(),
            'image_path' => $this->image?->image_path,
            'image_url' => $this->image_url,
            'tags' => TagResource::collection($this->tags)->resolve(),
            'category' => CategoryResource::make($this->category)->resolve(),
            'views' => $this->viewedProfiles->count(),
            'published_at' => $this->published_at,
            'is_liked' => $this->is_liked,
            'liked_profiles_count' => $this->liked_profiles_count,
        ];
    }
}
