<?php

namespace App\Console\Commands;

use App\Models\Post;
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
        $post = Post::find(8);

        if ($action === 'r') {
            $this->line(Post::find(8));
            dump(Post::all()->toArray());
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
