<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
