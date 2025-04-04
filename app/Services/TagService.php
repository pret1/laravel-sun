<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public static function storeBatch(string $data): array
    {
        $data = explode(",", $data);
        $tagIds = [];
        foreach ($data as $tag) {
            $tagIds[] = Tag::firstOrCreate([
                'title' => $tag
            ]);
        }

        return $tagIds;
    }
}
