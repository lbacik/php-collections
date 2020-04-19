<?php

declare(strict_types=1);

namespace Collection\Collection;

use Collection\Contract\Item;

class Simple
{
    private array $data = [];

    use Traditional\Add;
    use Traditional\Get;
    use Traditional\ToArray;

    public function init(Item ...$items): void
    {
        $this->data = $items;
    }
}
