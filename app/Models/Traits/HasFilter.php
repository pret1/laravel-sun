<?php

namespace App\Models\Traits;

use App\Http\Filter\PostFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    public function scopeFilter(Builder $builder, array $data): Builder
    {
        $ClassFilter = "\\App\\Http\\Filter\\" . class_basename($this) . "Filter";
        if(class_exists($ClassFilter)) {
            return (new $ClassFilter)->apply($data, $builder);
        }

        return $builder;
    }
}
