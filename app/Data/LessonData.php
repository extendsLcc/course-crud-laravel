<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class LessonData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public string $description,
        public string $video_url,
        public int $order,
    ) {
    }
}
