<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class GoNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:go-notifications';

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
        $user = User::first();
        Notification::send($user, new UserNotification());
    }
}
