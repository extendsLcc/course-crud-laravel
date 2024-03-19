<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class LoginInputData extends Data
{
    public function __construct(
        #[Email]
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
