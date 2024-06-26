<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'cover_url',
    ];

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order the courses by the date they were updated.
     */
    public function scopeUpdatedRecently($builder): void
    {
        $builder->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc');
    }

    protected static function booted(): void
    {
        static::deleted(function (Course $course) {
            $course->lessons()->delete();
            $course->modules()->delete();
        });
    }
}
