<?php

namespace Database\Factories;

use App\Models\Lesson;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory {
    protected $model = Lesson::class;

    public function definition(): array {
        return [
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'video_url' => $this->faker->url(),
            'order' => $this->faker->randomNumber(),
        ];
    }
}
