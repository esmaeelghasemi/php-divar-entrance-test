<?php

namespace App\Core\Abstracts;

abstract class Collection
{
    protected static array $items = [];
    protected string $separator = ' ';

    /**
     * @param Model|null $data
     */
    public function __construct(protected ?Model $data = null)
    {
    }

    /**
     * Make collection response to array
     * @param array|null $data
     * @return array
     */
    public function toArray(?array $data = []): array
    {
        if (empty(static::$items)) {

            return $this->makeArray($data);
        }

        $collection = [];
        foreach (static::$items as $item) {

            $collection[] = (new static($item))->makeArray();
        }

        return $collection;
    }

    /**
     * make collection response to string
     * @param array|null $data
     * @return string
     */
    public function toString(?array $data = []): string
    {
        if (empty(static::$items)) {

            return $this->makeString($data);
        }

        $collection = '';
        foreach (static::$items as $item) {

            $prepareItem = (new static($item))->makeString();
            $collection .= $prepareItem . $this->separator;
        }

        return $collection;
    }

    /**
     * make collect
     * @param array $items
     * @return Collection
     */
    public static function collect(array $items): Collection
    {
        static::$items = $items;
        return new static();
    }

    /**
     * make array | should implement in child
     * @param array|null $data
     * @return array
     */
    protected function makeArray(?array $data = []): array
    {
        return [];
    }

    /**
     * make string | should implement in child
     * @param array|null $data
     * @return string
     */
    protected function makeString(?array $data = []): string
    {
        return '';
    }
}