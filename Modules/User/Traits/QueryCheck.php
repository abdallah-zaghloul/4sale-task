<?php

namespace Modules\User\Traits;

use Illuminate\Support\Collection;

trait QueryCheck
{
    public function numberFormat(string $queryKey): ?string
    {
        return match (true){
            is_numeric($query = request()->query($queryKey)) => number_format(num: $query, decimals: 2, thousands_separator: null),
            default => null
        };
    }

    public function queryValidEnums(string $queryKey, callable $callable, string $separator = ','): ?array
    {
        return collect(explode($separator, request()->query($queryKey)))->whenNotEmpty(
            fn(Collection $collection) => $collection->transform(fn($queryParam) => $callable($queryParam))->filter()->unique()->all(),
            fn(Collection $collection) => null
        );
    }
}
