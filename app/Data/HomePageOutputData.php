<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class HomePageOutputData extends Data
{
    public function __construct(
        public int $coursesCount,
        public int $usersCount,
        public int $modulesCount,
        public int $lessonsCount,
        #[DataCollectionOf(CourseTableOutputData::class)]
        public DataCollection $recentlyUpdatedCourses,
    ) {
    }
}
