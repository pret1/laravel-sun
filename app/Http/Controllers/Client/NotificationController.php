<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Notification\MakrReadRequest;
use App\Http\Resources\Natification\UserNatificationResource;

class NotificationController extends Controller
{
    public function markRead(MakrReadRequest $request)
    {
        $data = $request->validated();

        $ids = collect($data['notifications'])->pluck('id')->all();

        auth()->user()
            ->userNotifications()
            ->whereIn('id', $ids)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $notifications = auth()->user()
            ->userNotifications()
            ->whereNull('read_at')
            ->get();

        $notifications = UserNatificationResource::collection($notifications)->resolve();

        return response()->json(['notifications' => $notifications]);
    }
}
