<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function show(Tag $tag)
    {
        return $tag;
    }

    public function store()
    {
        $data = [
            'title' => 'new tag',
        ];

        return Tag::create($data);
    }

    public function update(Tag $tag)
    {
        $data = [
            'title' => 'update tag',
        ];

        $tag->update($data);
        return $tag;
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response('deleted', 200);
    }
}
