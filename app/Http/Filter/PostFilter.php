<?php

namespace App\Http\Filter;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostFilter extends AbstractFilter
{
    protected array $filters = [
        'title',
        'content',
        'category_title',
        'published_at_from',
        'published_at_to',
        'profile_id',
        'tag_title',
        'likes_from',
        'likes_to',
        'liked_by_profile'
    ];

    protected function title(Builder $builder, string $value): void
    {
        $builder->where('title', 'ilike', '%' . $value . '%');
    }

    protected function content(Builder $builder, string $value): void
    {
        $builder->where('content', 'ilike', '%' . $value . '%');
    }

    protected function categoryTitle(Builder $builder, string $value): void
    {
        $builder->whereRelation('category', 'title', 'ilike', '%' . $value . '%');
    }

    protected function publishedAtFrom(Builder $builder, string $value): void
    {
        $builder->where('published_at', '>=', $value);
    }

    protected function publishedAtTo(Builder $builder, string $value): void
    {
        $builder->where('published_at', '<=', $value);
    }

    protected function profileId(Builder $builder, int $value): void
    {
        $builder->where('profile_id', $value);
    }

    protected function tagTitle(Builder $builder, string $value): void
    {
//        $builder->whereHas('tags', function ($q) use ($value) {
//            $q->where('title', 'ilike', "%$value%");
//        });
        $builder->whereRelation('tags', 'title', 'ilike', '%' . $value . '%');
    }

    protected function likesTo(Builder $builder, int $value): void
    {
//        $builder->has('likedProfiles', '<=', $value)->ddRawSql(); // ->ddRawSql() keep in mind
        $builder->has('likedProfiles', '<=', $value);
//        $builder->where(function ($query) use ($value) {
//            $query->whereHas('likedProfiles', function ($q) use ($value) {
//                $q->select('likeable_id')
//                    ->groupBy('likeable_id')
//                    ->havingRaw('COUNT(*) <= ?', [$value]);
//            })
//                ->orWhereDoesntHave('likedProfiles');
//        });
    }

    protected function likesFrom(Builder $builder, int $value): void
    {
        $builder->whereHas('likedProfiles', function ($q) use ($value) {
            $q->select('likeable_id')
                ->groupBy('likeable_id')
                ->havingRaw('COUNT(*) >= ?', [$value]);
        });
    }

    protected function likedByProfile(Builder $builder, int $profileId): void
    {
        $builder->whereHas('likedProfiles', function ($q) use ($profileId) {
            $q->where('profile_id', $profileId);
        });
    }
}
