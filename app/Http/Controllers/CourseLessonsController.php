<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\CreateLessonInputData;
use App\Data\ReorderLessonsInputData;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Patch;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;

class CourseLessonsController extends Controller
{
    #[Post('/courses/modules/{module}/lessons', name: 'courses.modules.lessons.store')]
    public function store(Module $module, CreateLessonInputData $createLessonDto)
    {
        DB::transaction(fn () => $module
            ->lessons()
            ->create([
                ...$createLessonDto->toArray(),
                'order' => ($module
                    ->lessons()
                    ->orderBy('order', 'desc')
                    ->first('order')
                    ?->order ?? -1) + 1, // start from 0
            ])
        );

        return redirect()->back()->with('success', 'Lesson created successfully');
    }

    #[Put('/courses/modules/lessons/{lesson}', name: 'courses.modules.lessons.update')]
    public function update(Lesson $lesson, CreateLessonInputData $createLessonDto)
    {
        DB::transaction(fn () => $lesson->update($createLessonDto->toArray()));

        return redirect()->back()->with('success', "Lesson {$lesson->title} successfully updated");
    }

    #[Delete('/courses/modules/lessons/{lesson}', name: 'courses.modules.lessons.delete')]
    public function delete(Lesson $lesson)
    {
        DB::transaction(fn () => $lesson->delete());

        return redirect()->back()->with('success', "Lesson {$lesson->title} successfully deleted");
    }

    #[Patch('/courses/modules/lessons', name: 'courses.modules.lessons.reorder')]
    public function reorder(ReorderLessonsInputData $reorderLessonsInputData)
    {
        DB::transaction(function () use ($reorderLessonsInputData) {
            foreach ($reorderLessonsInputData->lessonsOrder as $order => $lessonId) {
                Lesson::whereId($lessonId)
                    ->where('order', '!=', $order)
                    ->update(['order' => $order]);
            }
        });

        return redirect()->back();
    }
}
