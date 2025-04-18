<?php

namespace App\Http\Resources\Comment\Client;

use App\Http\Resources\Profile\ProfileResource;
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
//        dd($this->profile);
//        dd($this->profile_id);
        return [
            'id' => $this->id,
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'content' => $this->content,
        ];
    }
}
