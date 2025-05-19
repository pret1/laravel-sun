<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'content' => $this->content,
            'chat_id' => $this->chat_id,
            'profile_id' => $this->profile_id,
            'is_self' => $this->is_self,
            'author_name' => $this->profile->name,
            'read_at' => $this->read_at,
            'is_unread' => is_null($this->read_at) && $this->profile_id !== auth()->user()->profile->id,
        ];
    }
}
