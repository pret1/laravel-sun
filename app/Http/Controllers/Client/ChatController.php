<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Chat\Group\StoreGroupeRequest;
use App\Http\Requests\Client\Chat\StoreMessageRequest;
use App\Http\Requests\Client\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Chat;
use App\Models\Profile;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Request;

class ChatController extends Controller
{
    public function store(StoreRequest $request, ChatService $chatService): RedirectResponse
    {
        $data = $request->validated();
        $chat = $chatService->findOrCreateChat(auth()->user()->profile->id, $data['profile_id']);

        return to_route('client.chats.show', ['chat' => $chat]);
    }

    public function show(Chat $chat): Response|JsonResponse
    {
        $paginatedMessages = $chat->messages()->latest()->paginate(5);

        $messages = MessageResource::collection($paginatedMessages);

        $chat = ChatResource::make($chat);

        $unreadCount = $chat->messages()
            ->where('profile_id', '!=', auth()->user()->profile->id)
            ->whereNull('read_at')
            ->count();

        $chat->messages()
            ->where('profile_id', '!=', auth()->user()->profile->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        if (Request::wantsJson()) {
            return response()->json([
                'chat' => $chat,
                'messages' => $messages,
                'unreadCount' => $unreadCount,
                'links' => $paginatedMessages->linkCollection(),
            ]);
        }

        return inertia('Client/Chat/Show', [
            'chat' => $chat,
            'messages' => $messages,
            'unreadCount' => $unreadCount,
            'links' => $paginatedMessages->linkCollection(),
        ]);
    }

    public function storeMessage(StoreMessageRequest $request, Chat $chat)
    {
        $data = $request->validationData();
        $message = $chat->messages()->create($data);
        return MessageResource::make($message)->resolve();
    }

    public function createGroup(): Response
    {
        $profiles = ProfileResource::collection(Profile::all())->resolve();
        return Inertia::render('Client/Chat/Group/Create', [
            'profiles' => $profiles,
        ]);
    }

    public function storeGroup(StoreGroupeRequest $request): JsonResponse
    {
        $data = $request->validated();

        $chat = Chat::create();

        $chat->profiles()->sync($data['profile_ids']);

        $chat->profiles()->attach(auth()->user()->profile->id);

        return response()->json(['chat_id' => $chat->id]);
//        return to_route('client.chats.show', ['chat' => $chat]);
    }
}
