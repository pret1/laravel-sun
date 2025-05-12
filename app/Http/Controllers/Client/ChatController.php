<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Chat\StoreMessageRequest;
use App\Http\Requests\Client\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ChatController extends Controller
{
    public function store(StoreRequest $request, ChatService $chatService): RedirectResponse
    {
        $data = $request->validated();
        $chat = $chatService->findOrCreateChat(auth()->user()->profile->id, $data['profile_id']);

        return to_route('client.chats.show', ['chat' => $chat]);
    }

    public function show(Chat $chat): Response
    {
        $chat = ChatResource::make($chat)->resolve();

        return inertia('Client/Chat/Show', compact('chat'));
    }

    public function storeMessage(StoreMessageRequest $request, Chat $chat): array
    {
        $data = $request->validationData();
        $message = $chat->messages()->create($data);
        return MessageResource::make($message)->resolve();
    }
}
