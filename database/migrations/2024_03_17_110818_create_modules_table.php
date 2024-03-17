<?php

use App\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('order');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignIdFor(Course::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
