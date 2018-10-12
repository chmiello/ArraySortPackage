<?php

namespace Chmiello\ArraySortPackage;

class ArraySort
{
    private $items;

    public function __construct(array $array)
    {
        $this->items = $array;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}