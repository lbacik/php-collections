<?php

declare(strict_types=1);

namespace Tests;

use Collection\Collection\Exception\IndexOutOfBoundsException;
use Collection\Contract\Collection;
use Collection\Contract\Item;
use PHPUnit\Framework\TestCase;
use TypeError;

abstract class AbstractTest extends TestCase
{
    protected Collection $collection;

    /**
     * @dataProvider initData
     */
    public function testInit(array $data, bool $error): void
    {
        $this->setErrorHandler($error, TypeError::class);

        $this->collection->init($data);
        $this->assertSame($data, $this->collection->toArray());
    }

    /**
     * @param $item mixed
     * @dataProvider addData
     */
    public function testAdd($item, bool $error): void
    {
        $this->setErrorHandler($error, TypeError::class);

        $this->collection->add($item);
        $this->assertSame([$item], $this->collection->toArray());
    }

    /**
     * @dataProvider getData
     * @param $expected mixed
     */
    public function testGet(array $data, int $index, $expected): void
    {
        if ($expected instanceof IndexOutOfBoundsException) {
            $this->expectException(IndexOutOfBoundsException::class);
        }
        $this->collection->init($data);
        $this->assertSame($expected, $this->collection->get($index));
    }

    public function initData(): array
    {
        return [
            [
                'data' => [],
                'error' => false,
            ],
            [
                'data' => [
                    new class {},
                ],
                'error' => true,
            ],
            [
                'data' => [
                    new class implements Item {},
                    new class implements Item {},
                ],
                'error' => false,
            ],
            [
                'data' => [
                    new class implements Item {},
                    new class {},
                    new class implements Item {},
                ],
                'error' => true,
            ]

        ];
    }

    public function addData(): array
    {
        return [
            [
                'item' => null,
                'error' => true,
            ],
            [
                'item' => 'foo',
                'error' => true,
            ],
            [
                'item' => 12,
                'error' => true,
            ],
            [
                'item' => [],
                'error' => true,
            ],
            [
                'item' => new class {},
                'error' => true,
            ],
            [
                'item' => new class implements Item {},
                'error' => false
            ],
        ];
    }

    public function getData(): array
    {
        return [
            [
                [],
                1,
                IndexOutOfBoundsException::create(1),
            ],
            [
                [
                    new class implements Item {},
                ],
                1,
                IndexOutOfBoundsException::create(1),
            ],
            [
                [
                    new class implements Item {},
                    $result = new class implements Item {},
                ],
                1,
                $result,
            ],

        ];
    }

    protected function setErrorHandler(bool $error, string $errorType): void
    {
        if ($error === true) {
            $this->expectException($errorType);
        }
    }
}

