<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\CourseTableOutputData;
use App\Data\HomePageOutputData;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Spatie\LaravelData\DataCollection;
use Spatie\RouteAttributes\Attributes\Get;

class HomeController extends Controller
{
    #[Get('', name: 'home')]
    public function __invoke()
    {
        return hybridly('home-page', new HomePageOutputData(
            coursesCount: Course::count(),
            usersCount: User::count(),
            modulesCount: Module::count(),
            lessonsCount: Lesson::count(),
            recentlyUpdatedCourses: CourseTableOutputData::collect(
                Course::updatedRecently()
                    ->withCount(['modules', 'lessons'])
                    ->limit(5)
                    ->get(),
                DataCollection::class
            ),
        ));
    }
}
