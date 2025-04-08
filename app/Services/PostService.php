<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * @throws Exception
     */
    public static function store(array $data): Post
    {
        $post = null;

        try {

            DB::beginTransaction();

            $post = Post::create($data['post']);
            $tagIds = TagService::storeBatch($data['tags']);
            $post->tags()->attach($tagIds);

            if ($data['image_paths']) {
                foreach ($data['image_paths'] as $image) {
                    $post->image()->create(['image_path' => $image]);
                }
            }

            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $post;
    }
}
