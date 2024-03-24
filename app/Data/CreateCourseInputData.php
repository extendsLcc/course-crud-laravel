<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class CreateCourseInputData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        #[Url]
        public string $cover_url,
    ) {
    }
}
