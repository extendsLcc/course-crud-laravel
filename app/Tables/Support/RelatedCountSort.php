<?php

namespace App\Tables\Support;

use Hybridly\Refining\Sorts\Sort;
use Illuminate\Contracts\Database\Eloquent\Builder;

class RelatedCountSort extends Sort
{
    public function apply(Builder $builder, string $direction, string $property): void
    {
        $builder->orderBy(
            column: $property,
            direction: $direction,
        );
    }
}
