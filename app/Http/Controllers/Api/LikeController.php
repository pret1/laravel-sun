<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Like\StoreRequest;
use App\Http\Requests\Api\Like\UpdateRequest;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Like::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return Like::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        return $like;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Like $like)
    {
        $data = $request->validated();
        $like->update($data);
        return $like;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        $like->delete();
        return response('success deleted', 200);
    }
}
