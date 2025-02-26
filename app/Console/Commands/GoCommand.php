<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
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
            $post = Post::create([
                'title' => 'Go Post',
                'content' => 'This is a test post',
                'is_published' => true,
                'published_at' => now(),
                'category_id' => '1',
                'profile_id' => '1', //TODO: filled
            ]);
            $post->update([
                'title' => 'Updated title',
                'content' => 'GO Updated content',
                'is_published' => false
            ]);
            $post->delete();
            Post::find(1);

            //------morphs----------
//            $post = Post::first();
//            $post->image()->create();
//            $image = Image::first();
//            dd($image->imageable);
//            dd($post->image);

//            $post->comments()->create([
//                'content' => 'ddddddd',
//                'status' => true,
//                'profile_id' => $post->profile_id
//            ]);

//            $comment = Comment::first();
//            dd($comment->commentable);

//            $post->likedProfiles()->attach(1);
//            $profile = Profile::first();
//            dd($profile->likedPosts);
//            $profile->likedComments()->attach(1);
//            dd($profile->likedComments);
            //----------------------

            // attach -- Attach(add) new
            // detach -- Detach(delete) specific
            // sync -- work with exist data, for example we want edit tags, we write expected tags and when we save, we expect save need tags, other way use array_dif -- Sync (Replace all existing with new)
            // syncWithoutDetaching -- Sync without detaching (Add new, keep existing)
            // toggle -- work with likes, just switched status -- Toggle (Attach if not exists, detach if exists)
            // updateExistingPivot -- work on shop or store -- Update pivot data (e.g., add custom fields like 'priority')

            //------COMMENTS---------
//            $comment = Comment::first();
//            $comment = Comment::find(3);
//            dd($comment->likedProfiles?->toArray());
//            dd($comment->post?->content);
//            dd($comment->profile?->toArray());
//            dd($comment->childrenComments?->toArray());
//            dd($comment->parentComment?->toArray());
//            dd($comment->category?->toArray());
            //------------------------------------------
//            dd($comment->user?->toArray());
            //------------------------------------------

            //-------CATEGORIES----------
//            $category = Category::first();
//            $category = Category::find(2);
//            dd($category->posts->toArray());
//            dd($category->comments->toArray());
            //--------------------------------------
//            dd($category->latestComment->toArray());
//            dd($category->profile->toArray());
            //---------------------------------

            //--------POSTS------------------
//            $post = Post::first();
//            $post = Post::find(2);
//            dd($post->category->toArray());
//            dd($post->tags->toArray());
//            dd($post->likedProfiles->toArray());
//            dd($post->comments->toArray());
            //-----------------------------------
//            dd($post->user?->toArray());
            //-------------------------------
//            $post = Post::find(2);
//            $tagIds = [2, 3, 4];
//            $post->tags()->attach($tagIds);
//            $post->tags()->detach([2]);
//            $post->tags()->sync([1, 3]);
//            $post->tags()->syncWithoutDetaching([5]);
//            $post->tags()->toggle([4, 6]);
//            $post->tags()->updateExistingPivot(3, ['created_at' => '2020-01-30']);
            //-------------------------------

            //---------Profiles----------
//            $profile = Profile::first();
//            $profile = Profile::find(2);
//            dd($profile->user->toArray());
//            dd($profile->likedPosts->toArray());
//            dd($profile->comments->toArray());
//            dd($profile->likedComments->toArray());
            //-----------------------------------------
//            dd($profile->categories->toArray());
//            dd($profile->tags->toArray());
            //-----------------------------
//            $profile = Profile::find(1);
//            $postIds = [2, 3, 4];
//            $profile->likedPosts()->attach($postIds);
//            $profile->likedPosts()->detach(2);
//            $profile->likedPosts()->sync([1, 3]);
//            $profile->likedPosts()->syncWithoutDetaching(5);
//            $profile->likedPosts()->toggle([4, 6]);
//            $profile->likedPosts()->updateExistingPivot(3, ['updated_at' => now()]);
            //----------------------------
//            $profile = Profile::find(1);
//            $profile->likedComments()->attach([1, 2, 3]);
//            $profile->likedComments()->detach(2);
//            $profile->likedComments()->sync(4, 5);
//            $profile->likedComments()->syncWithoutDetaching(6);
//            $profile->likedComments()->toggle([4, 7]);
//            $profile->likedComments()->updateExistingPivot(4, ['updated_at' => now()]);
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
//            dd($user->comments->toArray());
//            dd($user->posts->toArray());
//            dd($user->tags->toArray());
            //------------------------------
//            $user = User::find(5);
//            $user->roles()->attach([1, 2]);
//            $user->roles()->detach([1]);
//            $user->roles()->sync([2, 3]);
//            $user->roles()->syncWithoutDetaching([4]);
//            $user->roles()->toggle([2, 5]);
//            $user->roles()->updateExistingPivot(2, ['updated_at' => now()]);

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
