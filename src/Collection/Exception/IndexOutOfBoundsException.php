<?php

declare(strict_types=1);

namespace Collection\Collection\Exception;

use RuntimeException;

class IndexOutOfBoundsException extends RuntimeException
{
    public static function create(int $index): self
    {
        return new static("Index of of bound! Index: {$index}");
    }
}
