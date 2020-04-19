<?php

declare(strict_types=1);

namespace Collection\Infrastructure;

use ArrayObject;
use stdClass;
use TypeError;

class TypedCollection extends ArrayObject
{
    protected const TYPE = stdClass::class;

    private function __construct(
        $input = [],
        $flags = 0,
        $iterator_class = "ArrayIterator"
    ) {
        parent::__construct($input, $flags, $iterator_class);
    }

    public function offsetSet($index, $newval): void
    {
        $type = static::TYPE;
        if (! $newval instanceof $type) {
            throw new TypeError("Only values of type {$type} are supported");
        }
        parent::offsetSet($index, $newval);
    }

    public static function create(array $items): self
    {
        $collection = new static();
        foreach ($items as $item) {
            $collection[] = $item;
        }
        return $collection;
    }
}
