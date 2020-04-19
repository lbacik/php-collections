<?php

declare(strict_types=1);

namespace Collection\Collection;

use Collection\Contract\Collection;
use Collection\Contract\Item;
use Collection\Infrastructure\TypedCollection;

class Architect extends TypedCollection implements Collection
{
    protected const TYPE = Item::class;

    use ArrayAccess\Add;
    use ArrayAccess\Get;
    use ArrayAccess\ToArray;

    public function init(array $items): void
    {
        $this->exchangeArray([]);
        foreach($items as $item) {
            $this[] = $item;
        }
    }
}
