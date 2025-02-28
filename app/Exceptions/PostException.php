<?php

namespace App\Exceptions;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response([
            'message' => 'Post already created from post exception',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function ifPostExists(Post $post)
    {
        if(!$post->wasRecentlyCreated) {
            throw new PostException;
        }
    }
}
