<?php

namespace App\Listeners\Log;

use App\Events\Log\LoggingEnded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoggingEndedListener
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
    public function handle(LoggingEnded $event): void
    {
        dump('LoggingEnded');
    }
}
