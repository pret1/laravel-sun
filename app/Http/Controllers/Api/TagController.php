<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\StoreRequest;
use App\Http\Requests\Api\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tag::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return Tag::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return $tag;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response('success deleted tag', 200);
    }
}
