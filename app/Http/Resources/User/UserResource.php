<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'user_notifications_count' => $this->user_notifications_count,
            'notifications' => $this->userNotifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'content' => $notification->content,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at
                        ? $notification->created_at->format('d.m.Y H:i')
                        : null,
                ];
            }),
        ];
    }
}
