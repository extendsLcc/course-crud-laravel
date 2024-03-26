<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ModuleData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public int $order,
        #[DataCollectionOf(LessonData::class)]
        public DataCollection $lessons,
    ) {
    }
}
