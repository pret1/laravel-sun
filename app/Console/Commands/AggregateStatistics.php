<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Statistic;
use App\Models\View;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AggregateStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:aggregate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate daily statistics for posts, comments, likes, and views';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $yesterday = Carbon::yesterday();

        $postsCount = Post::whereDate('created_at', $yesterday)->count();
        $commentsCount = Comment::whereDate('created_at', $yesterday)->count();
        $likesCount = DB::table('likeables')
            ->whereDate('created_at', $yesterday)
            ->count();

        $viewsCount = DB::table('viewables')
            ->whereDate('created_at', $yesterday)
            ->count();

        $likesToViewsRatio = $viewsCount > 0 ? ($likesCount / $viewsCount) * 100 : null;
        $likesToCommentsRatio = $commentsCount > 0 ? ($likesCount / $commentsCount) * 100 : null;

        Statistic::updateOrCreate(
            [
                'date' => $yesterday,
                'posts_count' => $postsCount,
                'comments_count' => $commentsCount,
                'likes_count' => $likesCount,
                'views_count' => $viewsCount,
                'likes_to_views_ratio' => $likesToViewsRatio,
                'likes_to_comments_ratio' => $likesToCommentsRatio,
            ]
        );

        $this->info('Statistics aggregated successfully.');
    }
}
