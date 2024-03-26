<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Data;
use Symfony\Contracts\Service\Attribute\Required;

class ReorderLessonsInputData extends Data
{
    public function __construct(
        #[Required]
        #[ArrayType]
        /** @var array<int> */
        public array $lessonsOrder,
    ) {
    }

    public static function rules(): array
    {
        return [
            'lessonsOrder.*' => ['integer'],
        ];
    }
}
