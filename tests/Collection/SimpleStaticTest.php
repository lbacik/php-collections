<?php

declare(strict_types=1);

namespace Tests\Collection;

use Collection\Collection\SimpleStatic;
use Tests\AbstractTest;
use TypeError;

class SimpleStaticTest extends AbstractTest
{
    public function setUp(): void
    {
        $this->collection = new SimpleStatic();
    }

    /**
     * @dataProvider initData
     */
    public function testInitStatic(array $data, bool $error): void
    {
        if ($error) {
            $this->expectException(TypeError::class);
        }
        $collection = SimpleStatic::create(...$data);
        $this->assertSame($data, $collection->toArray());
    }
}
