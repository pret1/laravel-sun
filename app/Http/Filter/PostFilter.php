<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostFilter
{
    protected array $filters = [
        'title',
        'category_title',
        'published_at_from',
        'published_at_to',
    ];

    public function apply(array $data, Builder $builder): Builder
    {
        foreach ($this->filters as $filter) {
            if(isset($data[$filter])) {
                $methodName = Str::camel($filter);
                $this->$methodName($builder, $data[$filter]);
            }
        }

        return $builder;
    }


    private function title(Builder $builder, string $value): void
    {
        $builder->where('title', 'ilike', '%' . $value . '%');
    }

    private function categoryTitle(Builder $builder, $value): void
    {
        $builder->whereRelation('category', 'title', 'ilike', '%' . $value . '%');
    }

    private function publishedAtFrom(Builder $builder, $value): void
    {
        $builder->where('published_at', '>=', $value);
    }

    private function publishedAtTo(Builder $builder, $value): void
    {
        $builder->where('published_at', '<=', $value);
    }

}
