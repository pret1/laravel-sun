<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Post;

class PostObserver
{
    public function logEvent(string $event, Post $post, array $oldData = null): void
    {
        Log::create([
            'model' => Post::class,
            'event' => $event,
            'old_data' => $oldData,
            'new_data' => $post->toArray(),
        ]);
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->logEvent('created', $post);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->logEvent('updated', $post, $post->getOriginal());
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->logEvent('deleted', $post, $post->getOriginal());
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->logEvent('restored', $post, $post->getOriginal());
    }

}
