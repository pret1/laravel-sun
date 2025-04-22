<?php

namespace App\Console\Commands;

use App\Mail\Comment\StoredCommentMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GoMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:go-mail-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::find(1);
        Mail::to($user)->send(new StoredCommentMail());
    }
}
