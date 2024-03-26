<?php

declare(strict_types=1);

namespace App\Tables;

use App\Data\CourseTableOutputData;
use App\Models\Course;
use App\Tables\Support\RelatedCountSort;
use Hybridly\Refining\Filters;
use Hybridly\Refining\Sorts;
use Hybridly\Tables\Actions\InlineAction;
use Hybridly\Tables\Columns;
use Hybridly\Tables\Exceptions\TableModelNotFoundException;
use Hybridly\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

final class CoursesTable extends Table
{
    protected string $model = Course::class;

    protected string $data = CourseTableOutputData::class;

    protected int $recordsPerPage = 10;

    protected function defineColumns(): array
    {
        return [
            Columns\TextColumn::make('id')->label('#'),
            Columns\TextColumn::make('cover_url')->label('Cover'),
            Columns\TextColumn::make('name')->label('Name'),
            Columns\TextColumn::make('description')->label('Description'),
            Columns\TextColumn::make('modules_count')->label('Nº of Modules'),
            Columns\TextColumn::make('lessons_count')->label('Nº of Lessons'),
        ];
    }

    /**
     * @throws TableModelNotFoundException
     */
    protected function defineQuery(): Builder
    {
        return $this->getModel()->query()->withCount(['modules', 'lessons']);
    }

    protected function defineRefiners(): array
    {
        return [
            Sorts\Sort::make('id'),
            Sorts\Sort::make('name'),
            Sorts\Sort::make('description'),
            /**
             *  currently not supported @see https://hybridly.dev/guide/refining.html#querying-nested-relationships
             */
            // Sorts\Sort::make('modules_count'),
            // Sorts\Sort::make('lessons_count'),
            RelatedCountSort::make('modules_count'),
            RelatedCountSort::make('lessons_count'),
            Filters\Filter::make(property: 'name', alias: 'search')->loose(),
        ];
    }

    protected function defineActions(): array
    {
        return [
            InlineAction::make('delete')->action(function (Course $course) {
                DB::transaction(fn () => $course->delete());
                session()->flash('success', "Course #{$course->id} - {$course->name} deleted successfully");

                return back()->with('success', "Course #{$course->id} - {$course->name} deleted successfully");
            }),
        ];
    }

    protected function getRecordsPerPage(): int
    {
        $this->recordsPerPage = (int) request()->query('limit', 10);

        return $this->recordsPerPage;
    }

    protected function transformRecords(Paginator|CursorPaginator $paginator): Paginator|CursorPaginator
    {
        if ($this->getRecordsPerPage() !== 10) {
            return $paginator->appends('limit', $this->recordsPerPage);
        }

        return $paginator;
    }
}
