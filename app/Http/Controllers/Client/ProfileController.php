<?php
declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\ToggleSubscribeRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show(Profile $profile): Response
    {
        $authProfileId = auth()->user()->profile->id;
        $subscriptionsCount = $profile->subscribers()->count();
        $followersCount = $profile->subscribering()->count();
        $profile = ProfileResource::make($profile)->resolve();

        return inertia('Client/Profile/Show', compact(
            'profile',
            'authProfileId',
            'subscriptionsCount',
            'followersCount'));
    }

    public function toggleSubscribe(ToggleSubscribeRequest $request ,Profile $profile): JsonResponse
    {
        $data = $request->validated();
        $res = $profile->subscribers()->toggle($data['subscriber_id']);
        $subscriptionsCount = $profile->subscribers()->count();
        $followersCount = $profile->subscribering()->count();
        return response()->json([
           'is_subscriber' => count($res['attached']) > 0,
            'subscriber_count' => $subscriptionsCount,
            'followers_count' => $followersCount,
        ]);
    }
}
