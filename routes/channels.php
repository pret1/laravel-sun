<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('posts.{id}', function ($user, $id) {
    $a = (int) $user->id;
    return (int) $user->id === (int) $id;
});
