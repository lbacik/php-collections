<?php

declare(strict_types=1);

namespace Tests;

use Collection\Collection\Exception\IndexOutOfBoundException;
use Collection\Contract\Collection;
use Collection\Contract\Item;
use PHPUnit\Framework\TestCase;
use stdClass;
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
        if ($expected instanceof IndexOutOfBoundException) {
            $this->expectException(IndexOutOfBoundException::class);
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
                    new stdClass(),
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
                    new stdClass(),
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
                null,
                true,
            ],
            [
                'foo',
                true,
            ],
            [
                12,
                true,
            ],
            [
                [],
                true,
            ],
            [
                new stdClass(),
                true,
            ],
            [
                new class implements Item {},
                false
            ],
        ];
    }

    public function getData(): array
    {
        return [
            [
                [],
                1,
                IndexOutOfBoundException::create(1),
            ],
            [
                [
                    new class implements Item {},
                ],
                1,
                IndexOutOfBoundException::create(1),
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

