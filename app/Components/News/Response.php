<?php

namespace App\Components\News;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;

class Response implements Arrayable, JsonSerializable, Jsonable
{
    protected Collection $items;

    protected int $page;

    protected int $size;

    protected int $total;

    public function __construct(array $items, int $page, int $size, int $total)
    {
        $this->items = new Collection($items);
        $this->page = $page;
        $this->size = $size;
        $this->total = $total;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'page' => $this->page,
            'size' => $this->size,
            'total' => $this->total,
            'data' => $this->items->toArray(),
        ];
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param $options
     *
     * @return false|string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function getCollection(): Collection
    {
        return $this->items;
    }
}
