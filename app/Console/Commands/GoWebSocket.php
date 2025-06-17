<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Events\WsEvent;
use Illuminate\Console\Command;

class GoWebSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:go-web-socket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        WsEvent::dispatch();
    }
}
