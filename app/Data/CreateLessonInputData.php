<?php

declare(strict_types=1);

namespace App\Data;

use App\Rules\YoutubeOrVimeoVideoUrlRule;
use Spatie\LaravelData\Data;

class CreateLessonInputData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        #[YoutubeOrVimeoVideoUrlRule]
        public string $video_url,
    ) {
    }
}
