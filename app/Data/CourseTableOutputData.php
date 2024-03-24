<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class CourseTableOutputData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $cover_url,
        public int $modules_count,
        public int $lessons_count,
    ) {
    }
}
