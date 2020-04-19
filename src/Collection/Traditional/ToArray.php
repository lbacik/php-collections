<?php

declare(strict_types=1);

namespace Collection\Collection\Traditional;

trait ToArray
{
    public function toArray(): array
    {
        return $this->data;
    }
}
