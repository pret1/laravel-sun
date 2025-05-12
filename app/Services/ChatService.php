<?php

namespace App\Services;

use App\Models\Chat;

class ChatService
{
    public function findOrCreateChat(int $authProfileId, int $targetProfileId): Chat
    {
        $existingChat = Chat::whereHas('profiles', function ($query) use ($authProfileId) {
            $query->where('profile_id', $authProfileId);
        })->whereHas('profiles', function ($query) use ($targetProfileId) {
            $query->where('profile_id', $targetProfileId);
        })->first();

        if ($existingChat) {
            return $existingChat;
        }

        $chat = Chat::create();
        $chat->profiles()->syncWithoutDetaching([$authProfileId, $targetProfileId]);

        return $chat;
    }
}
