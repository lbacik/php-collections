<?php

declare(strict_types=1);

namespace Collection\Collection\Traditional;

use Collection\Collection\Exception\IndexOutOfBoundsException;
use Collection\Contract\Item;

trait Get
{
    public function get(int $index): Item
    {
        if ($index < 0 || $index >= count($this->data)) {
            throw IndexOutOfBoundsException::create($index);
        }
        return $this->data[$index];
    }
}
