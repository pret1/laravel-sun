<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\Message\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
//            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'messages' => $this->whenLoaded('messages', function () {
                return MessageResource::collection($this->messages);
            }),
        ];
    }
}
