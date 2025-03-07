<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;

class PostFilter
{
    protected array $filters = [
        'title',
        'category_title',
        'published_at_from',
        'published_at_to',
    ];

    public function apply(): Builder
    {
        foreach ($this->filters as $filter) {
            $this->$filter();
        }
    }


    private function title(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', '%' . $value . '%');
    }

    private function categoryTitle(Builder $builder, $value)
    {
        $builder->whereRelation('category', 'title', 'ilike', '%' . $value . '%');
    }

    private function publishedAtFrom(Builder $builder, $value)
    {
        $builder->where('published_at', '>=', $value);
    }

    private function publishedAtTo(Builder $builder, $value)
    {
        $builder->where('published_at', '<=', $value);
    }

}

if (isset($data['title'])) {
    $builder->where('title', 'ilike', '%' . $data['title'] . '%');
}

if (isset($data['category_title'])) {
    $postsQuery->whereRelation('category', 'title', 'ilike', '%' . $data['category_title'] . '%');
}

if (isset($data['published_at_from'])) {
    $postsQuery->where('published_at', '>=', $data['published_at_from']);
}

if (isset($data['published_at_to'])) {
    $postsQuery->where('published_at', '>=', $data['published_at_to']);
}
