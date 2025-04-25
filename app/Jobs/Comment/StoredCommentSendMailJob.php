<?php

namespace App\Jobs\Comment;

use App\Mail\Comment\StoredCommentMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class StoredCommentSendMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Post $post,
        private readonly ?Comment $comment = null,
        private readonly ?Comment $commentModel = null,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->post->user)->send(
            new StoredCommentMail(
                $this->comment ?? $this->commentModel,
                $this->comment ? $this->commentModel : null
            )
        );
    }
}
