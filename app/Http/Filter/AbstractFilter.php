<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class AbstractFilter
{
    protected array $filters = [];
    public function apply(array $data, Builder $builder): Builder
    {
        foreach ($this->filters as $filter) {
            if(isset($data[$filter])) {
                $methodName = Str::camel($filter);
                if(method_exists($this, $methodName)) {
                    $this->$methodName($builder, $data[$filter]);
                }
            }
        }

        return $builder;
    }
}
