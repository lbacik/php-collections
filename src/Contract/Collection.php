<?php

declare(strict_types=1);

namespace Collection\Contract;

use Collection\Collection\Exception\IndexOutOfBoundException;
use TypeError;

interface Collection
{
    /** @throws TypeError */
    public function init(array $items): void;

    /** @throws TypeError */
    public function add(Item $object): void;

    /** @throws IndexOutOfBoundException */
    public function get(int $index): Item;

    public function toArray(): array;
}
