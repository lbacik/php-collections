<?php

declare(strict_types=1);

namespace Tests\Collection;

use Collection\Collection\Architect;
use Tests\AbstractTest;

class ArchitectTest extends AbstractTest
{
    public function setUp(): void
    {
        $this->collection = Architect::create([]);
    }
}
