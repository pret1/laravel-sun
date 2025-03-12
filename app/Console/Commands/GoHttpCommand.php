<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GoHttpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GO Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //way 1
//        $response = Http::get('https://dummyjson.com/posts');
//        $posts = $response->json('posts');
        //way 2
//        $response = Http::get('http://172.17.0.1:8080/api/posts');
//        $posts = $response->collect();


//        foreach (PostHttpClient::make()->login()->index() as $post) {
//            Post::create([
//                'title' => $post['title'],
//            ]);
//        }

        $data = [
            'title' => 'HTTP update title',
            'content' => 'HTTP update content',
//            'is_published' => true,
//            'published_at' => '2025-03-06',
//            'category_id' => 1,
//            'profile_id' => 1,
        ];

        $client = PostHttpClient::make()->login();
//        $client->store($data);
//        $client->update(51, $data);
//        $post = $client->show(51);
//        $post = $client->delete(52);
//        $client->delete(51);
//        $this->info(json_encode($post, JSON_PRETTY_PRINT));
//        dump($post);
    }
}


