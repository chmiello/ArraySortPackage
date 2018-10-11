<?php

use PHPUnit\Framework\TestCase;
use Chmiello\ArraySortPackage\ArraySort;

class ArraySortTest extends TestCase
{
    public function testObjectCreate()
    {
        $this->assertInstanceOf(ArraySort::class, new ArraySort([]));
    }
}
