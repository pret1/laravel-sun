<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go {action=r}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Go command for CRUD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
//        $post = Post::find(8);

        if ($action === 'r') {

            //------COMMENTS---------
//            $comment = Comment::first();
//            $comment = Comment::find(3);
//            dd($comment->likedProfiles?->toArray());
//            dd($comment->post?->content);
//            dd($comment->profile?->toArray());
//            dd($comment->childrenComments?->toArray());
//            dd($comment->parentComment?->toArray());
            //------------------------------------------

            //-------CATEGORIES----------
//            $category = Category::first();
//            $category = Category::find(2);
//            dd($category->posts->toArray());
            //---------------------------------

            //--------POSTS------------------
//            $post = Post::first();
//            $post = Post::find(2);
//            dd($post->category->toArray());
//            dd($post->tags->toArray());
//            dd($post->likedProfiles->toArray());
//            dd($post->comments->toArray());
            //-------------------------------

            //---------Profiles----------
//            $profile = Profile::first();
//            $profile = Profile::find(2);
//            dd($profile->user->toArray());
//            dd($profile->likedPosts->toArray());
//            dd($profile->comments->toArray());
//            dd($profile->likedComments->toArray());
            //----------------------------

            //-----------Roles------------
//            $role = Role::first();
//            $role = Role::find(2);
//            dd($role->users->toArray());
            //-------------------------------

            //----------Tags--------------
//            $tag = Tag::first();
//            dd($tag->posts->toArray());
            //---------------------------

            //----------Users--------------
//            $user = User::first();
//            dd($user->roles->toArray());
//            dd($user->profile->toArray());
            //-------------------------------

//            $this->line(Post::find(8));
//            dump(Post::all()->toArray());
        } elseif($action === 'c') {
            Post::create([
               'title' => 'Command title',
               'content' => 'content command',
               'author' => 'author command',
               'is_published' => true,
               'likes' => 1,
               'image_path' => '/var/www/html/31231',
               'tag' => 'tag command',
               'category' => 'category command',
               'views' => 1,
               'published_at' => '2025-01-23 16:38:27',
            ]);

        } elseif ($action === 'u') {
            $post->update([
                'title' => 'Update Command title',
            ]);
            $this->info('update command title');
            $this->line($post);
        } elseif ($action === 'd') {
            $postDelete = Post::latest()->first();
            $postDelete->delete();
            $this->info('delete last post');
        }
    }
}
