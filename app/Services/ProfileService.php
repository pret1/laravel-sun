<?php

namespace App\Services;

use App\Models\Profile;

class ProfileService
{
    public static function store(array $data): Profile
    {
        return Profile::create($data);
    }
}
