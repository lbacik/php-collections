<?php

declare(strict_types=1);

namespace Collection\Collection\Traditional;

use Collection\Contract\Item;

trait Add
{
    public function add(Item $item): void
    {
        $this->data[] = $item;
    }
}
