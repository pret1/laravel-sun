<?php
declare(strict_types=1);

namespace App\Listeners\Post;

use App\Events\Post\PostCacheEvent;
use Illuminate\Support\Facades\Cache;

class ClearPostCacheListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCacheEvent $event): void
    {
        $key = md5(json_encode($event->data));
        Cache::forget($key);
    }
}
