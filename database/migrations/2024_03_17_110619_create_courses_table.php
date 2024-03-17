<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('cover_url');
            $table->softDeletes();
            $table->timestamps();

            /**
             * Not sure if course/module/lesson should be related to the user
             * who created it. But I'm adding it for now. This will not have
             * any effect on the application.
             */
            $table->foreignIdFor(User::class, 'created_by')
                ->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
