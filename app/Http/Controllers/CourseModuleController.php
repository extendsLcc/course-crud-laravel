<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\CreateModuleInputData;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;

class CourseModuleController extends Controller
{
    #[Post('/courses/{course}/modules', name: 'courses.modules.store')]
    public function store(Course $course, CreateModuleInputData $createModuleDto)
    {
        DB::transaction(fn () => $course
            ->modules()
            ->create([
                ...$createModuleDto->toArray(),
                'order' => ($course
                    ->modules()
                    ->orderBy('order', 'desc')
                    ->first('order')
                    ?->order ?? -1) + 1, // start from 0
            ])
        );

        return redirect()->back()->with('success', 'Module created successfully');
    }

    #[Put('/courses/modules/{module}', name: 'courses.modules.update')]
    public function update(Module $module, CreateModuleInputData $createModuleDto)
    {
        DB::transaction(fn () => $module->update($createModuleDto->toArray()));

        return redirect()->back()->with('success', "Module {$module->title} successfully updated");
    }

    #[Delete('/courses/modules/{module}', name: 'courses.modules.destroy')]
    public function destroy(Module $module)
    {
        DB::transaction(fn () => $module->delete());

        return redirect()->back()->with('success', "Module {$module->title} deleted successfully");
    }
}
