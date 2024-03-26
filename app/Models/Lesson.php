<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Relations\BelongsToThrough;
use Znck\Eloquent\Traits\BelongsToThrough as BelongsToThroughTrait;

class Lesson extends Model
{
    use BelongsToThroughTrait, HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'order',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function course(): BelongsToThrough
    {
        return $this->belongsToThrough(Course::class, Module::class);
    }

    protected static function booted(): void
    {
        static::created(function (Lesson $lesson) {
            $lesson->course()->touch();
        });
        static::updated(function (Lesson $lesson) {
            $lesson->course()->touch();
        });
        static::deleted(function (Lesson $lesson) {
            $lesson->course()->touch();
        });
    }
}
