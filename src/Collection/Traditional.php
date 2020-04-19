<?php

declare(strict_types=1);

namespace Collection\Collection;

use Collection\Contract\Collection;

class Traditional implements Collection
{
    protected array $data = [];

    use Traditional\Add;
    use Traditional\Get;
    use Traditional\ToArray;

    public function init(array $items): void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }
}
