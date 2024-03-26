<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\CreateCourseInputData;
use App\Data\EditCourseOutputData;
use App\Models\Course;
use App\Tables\CoursesTable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('courses')]
class CourseController extends Controller
{
    #[Get('', name: 'courses.index')]
    public function index()
    {
        return hybridly('course.index.course-index-page', [
            'courses' => CoursesTable::make(),
        ]);
    }

    #[Get('/create', name: 'courses.create')]
    public function create()
    {
        return redirect()->route('courses.index')->withFragment('create');
    }

    #[Post('', name: 'courses.store')]
    public function store(CreateCourseInputData $createCourseDto)
    {
        $createdCourse = auth()->user()->courses()->create($createCourseDto->toArray());

        return redirect()->route('courses.edit', $createdCourse)->withFragment('teste=1');
    }

    #[Get('/{course}', name: 'courses.edit')]
    public function edit(Course $course)
    {
        return hybridly('course.edit.course-edit-page',
            EditCourseOutputData::from($course->load([
                'modules' => fn (HasMany $query) => $query->orderBy('order'),
                'modules.lessons' => fn (HasMany $query) => $query->orderBy('order'),
            ]))
        );
    }

    #[Put('/{course}', name: 'courses.update')]
    public function update(Course $course, CreateCourseInputData $createCourseDto)
    {
        $course->update($createCourseDto->toArray());

        return redirect()->back()->with('success', 'Course updated successfully');
    }

    #[Delete('/{course}', name: 'courses.delete')]
    public function delete(Course $course)
    {
        return redirect()->back()->with(['message' => "Course {$course->id} deleted successfully"]);
    }
}
