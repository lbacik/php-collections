<?php

declare(strict_types=1);

namespace Collection\Infrastructure;

use Sushi\Validator\IlluminateValidationValidator;
use Sushi\Validator\KeysValidator;
use Sushi\ValueObject;

class EmptyValueObject extends ValueObject
{
    protected $validators = [
        KeysValidator::class,
        IlluminateValidationValidator::class,
    ];
}
