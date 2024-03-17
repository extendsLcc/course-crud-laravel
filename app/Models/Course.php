<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model {
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_url',
    ];

    public function modules(): HasMany {
        return $this->hasMany(Module::class);
    }

    public function leassons(): HasManyThrough {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }
}
