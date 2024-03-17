<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model {
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'order',
    ];

    public function module(): BelongsTo {
        return $this->belongsTo(Module::class);
    }
}
