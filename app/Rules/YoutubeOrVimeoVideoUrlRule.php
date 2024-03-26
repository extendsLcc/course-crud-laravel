<?php

declare(strict_types=1);

namespace App\Rules;

use Attribute;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Spatie\LaravelData\Attributes\Validation\CustomValidationAttribute;
use Spatie\LaravelData\Support\Validation\ValidationPath;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class YoutubeOrVimeoVideoUrlRule extends CustomValidationAttribute implements ValidationRule
{
    const YOUTUBE_REGEX = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

    const VIMEO_REGEX = '/(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/|player\.vimeo\.com\/video\/)([0-9]+)/';

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match(self::YOUTUBE_REGEX, $value) && ! preg_match(self::VIMEO_REGEX, $value)) {
            $fail("The $attribute must be a valid youtube or vimeo video URL.");
        }
    }

    public function getRules(ValidationPath $path): array|object|string
    {
        return new self();
    }
}
