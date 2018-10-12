<?php

use PHPUnit\Framework\TestCase;
use Chmiello\ArraySortPackage\ArraySort;

class ArraySortTest extends TestCase
{
    const NO_SORTED_ARRAY = [
        ['name' => 'Giacomo', 'surname' => 'Agostini', 'time' => 11.25],
        ['name' => 'Francesco', 'surname' => 'Bagnaia', 'time' => 11.23],
        ['name' => 'Marco', 'surname' => 'Bezzecchi', 'time' => 12.01],
        ['name' => 'Max', 'surname' => 'Biaggi', 'time' => 11.25],
        ['name' => 'Anthony', 'surname' => 'Groppi', 'time' => 11.48],
        ['name' => 'Valentino', 'surname' => 'Rossi', 'time' => 11.21],
        ['name' => 'Marco', 'surname' => 'Melandri', 'time' => 11.21],
        ['name' => 'Alessandro', 'surname' => 'Tonucci', 'time' => 11.25]
    ];

    public function testObjectCreate()
    {
        $this->assertInstanceOf(ArraySort::class, new ArraySort([]));
    }

    public function testgetItemsMethod()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $this->assertTrue(self::NO_SORTED_ARRAY === $instance->getItems());
    }
}
