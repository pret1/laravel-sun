<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' =>  $this->name,
            'phone' => $this->phone,
            'address' =>  $this->address,
            'gender' => $this->gender,
            'user_id' => $this->user_id,
            'is_subscriber' => $this->is_subscriber,
        ];
    }
}
