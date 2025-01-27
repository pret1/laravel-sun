<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store()
    {
        $data = [
            'login' => 'best_login',
            'email' => 'best@email.com',
            'password' => 'qazwsx',
            'role' => 'user',
        ];

        return User::create($data);
    }

    public function update(User $user)
    {
        $data = [
            'login' => 'update_login',
        ];

        $user->update($data);
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response('deleted', 200);
    }
}
