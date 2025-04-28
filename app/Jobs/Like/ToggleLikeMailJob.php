<?php

namespace App\Jobs\Like;

use App\Mail\Like\LikeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class ToggleLikeMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
     private readonly Model $likeable,
     private readonly bool $isLiked,
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->likeable->user)->send(new LikeMail($this->likeable, $this->isLiked));
    }
}
