<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'post' => $this->post,
            'content' => $this->content,
            'author' => $this->author,
            'status' => $this->status,
            'parent' => $this->parent,
            'like' => $this->like,
        ];
    }
}
