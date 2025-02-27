<?php

namespace App\Listeners\Log;

use App\Events\Log\LoggingStarted;

class LoggingStartedListener
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
    public function handle(LoggingStarted $event): void
    {
        dump('LoggingStarted');
    }
}
