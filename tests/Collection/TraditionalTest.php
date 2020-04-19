<?php

declare(strict_types=1);

namespace Tests\Collection;

use Collection\Collection\Traditional;
use Tests\AbstractTest;

class TraditionalTest extends AbstractTest
{
    public function setUp(): void
    {
        $this->collection = new Traditional();
    }
}
