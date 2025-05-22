<?php

namespace App\Http\Resources\Natification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNatificationResource extends JsonResource
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
            'read_at' => $this->read_at,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
