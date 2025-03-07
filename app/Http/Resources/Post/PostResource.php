<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
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
            'profile_id' => $this->profile_id,
            'is_published' => $this->is_published,
//            'likes' => $this->likes,
//            'image_path' => $this->image_path,
//            'tag' => $this->tag,
            'category' => CategoryResource::make($this->category)->resolve(),
//            'views' => $this->views,
            'published_at' => $this->published_at,
        ];
    }
}
