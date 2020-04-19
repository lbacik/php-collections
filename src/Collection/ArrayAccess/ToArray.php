<?php

declare(strict_types=1);

namespace Collection\Collection\ArrayAccess;

trait ToArray
{
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }
}
