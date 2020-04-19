<?php

declare(strict_types=1);

namespace Collection\Collection;

use Collection\Collection\Exception\IndexOutOfBoundException;
use Collection\Contract\Collection;
use Collection\Contract\Item;
use Collection\Infrastructure\EmptyValueObject;
use Sushi\Validator\Exception\ValidationException;
use RuntimeException;
use TypeError;

class StrangeThing extends EmptyValueObject implements Collection
{
    public const DATA = 'data';

    protected $keys = [
        self::DATA => 'present|array',
        self::DATA . '.*' => 'instance_of:' . Item::class,
    ];

    public function init(array $items): void
    {
        throw new RuntimeException("Not implemented");
    }

    public function add(Item $item): void
    {
        throw new RuntimeException("Not implemented");
    }

    public function get(int $index): Item
    {
        if ($index < 0 || $index >= count($this[self::DATA])) {
            throw IndexOutOfBoundException::create($index);
        }
        return $this[self::DATA][$index];
    }

    public function data(): array
    {
        return $this->offsetGet(self::DATA);
    }

    /**
     * @throws TypeError
     */
    public static function create(array $data): self
    {
        try {
            $result = new static([self::DATA => $data]);
        } catch (ValidationException $exception) {
            throw new TypeError($exception->getMessage());
        }
        return $result;
    }
}
