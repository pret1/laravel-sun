<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class GoDbQueries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:go-db-queries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description app:go-db-queries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::listen(function (QueryExecuted $query) {
            dump($query->toRawSql());
        });

        $usersWithPosts = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->join('posts', 'profiles.id', '=', 'posts.profile_id')
            ->select('users.*', 'posts.title as post_title')
            ->get();

        $postsWithCategories = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->join('tags', 'tags.id', '=', 'post_tag.tag_id')
            ->select('posts.*', 'tags.*', 'categories.title as category_name')
            ->get();

        $commentsWithPosts = DB::table('comments')
            ->join('posts', function (JoinClause $join) {
                $join->on('comments.commentable_id', '=', 'posts.id')
                    ->where('comments.commentable_type', '=', 'App\\Models\\Post');
            })
            ->join('likeables', function (JoinClause $join) {
                $join->on('likeables.likeable_id', '=', 'comments.id')
                    ->where('likeables.likeable_type', '=', 'App\\Models\\Comment');
            })
            ->select('comments.*', 'posts.content as post_content')
            ->get();

//        dump($commentsWithPosts);
//        dump($postsWithCategories);
//        dump($usersWithPosts);
    }
}
