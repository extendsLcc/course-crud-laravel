<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'cover_url' => $this->faker->imageUrl(),
            'user_id' => 1,
        ];
    }
}
