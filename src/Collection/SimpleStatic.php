<?php

declare(strict_types=1);

namespace Collection\Collection;

use Collection\Contract\Item;

class SimpleStatic extends Traditional
{
    public static function create(Item ...$items): self
    {
        $collection = new static();
        (fn(array $data) => $this->data = $data)
            ->call($collection, $items);
        return $collection;
    }
}
