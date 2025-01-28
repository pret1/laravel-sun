<?php

namespace App\Http\Controllers;

use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return ProfileResource::collection(Profile::all())->resolve();
    }

    public function show(Profile $profile)
    {
        return ProfileResource::make($profile)->resolve();
    }

    public function store()
    {
        $data = [
            'name' => 'profile name',
            'phone' => '2313123' . rand(1, 999999),
            'address' => 'profile store',
            'gender' => 'male',
        ];

        Profile::create($data);

        return Profile::all();
    }

    public function update(Profile $profile)
    {
        $data = [
            'name' => 'update profile name',
        ];

        $profile->update($data);
        return $profile;
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response('success deleted', 200);
    }
}
