<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory()
            ->for(User::whereEmail('dev@agenciaecode.com.br')->first())
            ->count(60)
            ->create()
            ->each(function (Course $course) {
                Module::factory()
                    ->count(rand(1, 3))
                    ->for($course)
                    ->create()
                    ->each(function (Module $module) {
                        Lesson::factory()
                            ->count(rand(1, 5))
                            ->for($module)
                            ->create();
                    });
            });
    }
}
