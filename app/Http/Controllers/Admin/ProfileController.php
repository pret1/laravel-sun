<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\StoreRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProfileController extends Controller
{
    public function index(): Response
    {
        $profiles = ProfileResource::collection(Profile::all())->resolve();
        return inertia("Admin/Profile/Index", compact('profiles'));
    }

    public function show(Profile $profile): Response
    {
        $profile = ProfileResource::make($profile)->resolve();
        return inertia("Admin/Profile/Show", compact('profile'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia("Admin/Profile/Create");
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $profile = Profile::create($data);
        return ProfileResource::make($profile)->resolve();
    }
}
