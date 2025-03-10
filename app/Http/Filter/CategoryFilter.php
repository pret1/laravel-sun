<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends AbstractFilter
{
    protected array $filters = [
        'title',
    ];

    protected function title(Builder $builder, string $value): void
    {
        $builder->where('title', 'ilike', '%' . $value . '%');
    }
}
