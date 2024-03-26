<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class EditCourseOutputData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $cover_url,
        #[DataCollectionOf(ModuleData::class)]
        public DataCollection $modules,
    ) {
    }
}
