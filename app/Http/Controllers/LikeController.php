<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        return Like::all();
    }

    public function show(Like $like)
    {
        return $like;
    }

    public function store()
    {
        $data = [
            'count' => '13',
            'type' => 'like',
            'author' => 'Leonardo',
        ];

        return Like::create($data);
    }

    public function update(Like $like)
    {
        $data = [
            'count' => '13',
            'type' => 'like',
            'author' => 'update author'
        ];

        $like->update($data);
        return $like;
    }

    public function destroy(Like $like)
    {
        $like->delete();
        return response('deleted', 200);
    }
}
