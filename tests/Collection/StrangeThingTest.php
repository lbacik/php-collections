<?php

declare(strict_types=1);

namespace Tests\Collection;

use Collection\Collection\Exception\IndexOutOfBoundException;
use Collection\Collection\StrangeThing;
use Tests\AbstractTest;
use TypeError;

class StrangeThingTest extends AbstractTest
{
    public function setUp(): void
    {
        $this->collection = StrangeThing::create([]);
    }

    /**
     * @dataProvider initData
     */
    public function testInit(array $data, bool $error): void
    {
        $this->setErrorHandler($error, TypeError::class);

        $collection = StrangeThing::create($data);
        $this->assertSame($data, $collection->data());
    }

    /**
     * @dataProvider addData
     */
    public function testAdd($item, bool $error): void
    {
        $this->setErrorHandler($error, TypeError::class);

        $collection = StrangeThing::create(
            array_merge($this->collection->data(), [$item])
        );
        $this->assertSame([$item], $collection->data());
    }

    /**
     * @dataProvider getData
     */
    public function testGet(array $data, int $index, $expected): void
    {
        if ($expected instanceof IndexOutOfBoundException) {
            $this->expectException(IndexOutOfBoundException::class);
        }
        $collection = StrangeThing::create($data);
        $this->assertSame($expected, $collection->get($index));
    }
}
