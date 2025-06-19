<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Events\UserNotification\SendWsNotificationEvent;
use App\Events\WsEvent;
use App\Models\UserNotification;
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
        $userNotification = UserNotification::create([
            'user_id' => 4,
            'content' => '222222222222222 asdasdasdasda'
        ]);

        SendWsNotificationEvent::broadcast($userNotification);
    }
}
