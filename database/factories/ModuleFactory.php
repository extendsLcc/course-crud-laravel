<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Module;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition(): array
    {
        return [
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
            'title' => $this->faker->word(),
            'order' => $this->faker->randomNumber(),
        ];
    }
}
