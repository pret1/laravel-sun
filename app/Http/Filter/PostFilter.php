<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostFilter extends AbstractFilter
{
    protected array $filters = [
        'title',
        'category_title',
        'published_at_from',
        'published_at_to',
    ];

    protected function title(Builder $builder, string $value): void
    {
        $builder->where('title', 'ilike', '%' . $value . '%');
    }

    protected function categoryTitle(Builder $builder, $value): void
    {
        $builder->whereRelation('category', 'title', 'ilike', '%' . $value . '%');
    }

    protected function publishedAtFrom(Builder $builder, $value): void
    {
        $builder->where('published_at', '>=', $value);
    }

    protected function publishedAtTo(Builder $builder, $value): void
    {
        $builder->where('published_at', '<=', $value);
    }

}
