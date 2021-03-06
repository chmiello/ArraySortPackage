<?php

use PHPUnit\Framework\TestCase;
use Chmiello\ArraySortPackage\ArraySort;

/**
 * Class ArraySortTest
 *
 * @category PHP
 * @package  Chmiello\ArraySortPackage
 * @author   chmiello <bartek@chmiello.pl>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/chmiello/ArraySortPackage
 */
class ArraySortTest extends TestCase
{
    /**
     * Array with no sorted items
     */
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

    /**
     * Array with sorting items
     * ASC time
     */
    const SORTED_ONE_DIMENSION = [
        ['name' => 'Valentino', 'surname' => 'Rossi', 'time' => 11.21],
        ['name' => 'Marco', 'surname' => 'Melandri', 'time' => 11.21],
        ['name' => 'Francesco', 'surname' => 'Bagnaia', 'time' => 11.23],
        ['name' => 'Giacomo', 'surname' => 'Agostini', 'time' => 11.25],
        ['name' => 'Max', 'surname' => 'Biaggi', 'time' => 11.25],
        ['name' => 'Alessandro', 'surname' => 'Tonucci', 'time' => 11.25],
        ['name' => 'Anthony', 'surname' => 'Groppi', 'time' => 11.48],
        ['name' => 'Marco', 'surname' => 'Bezzecchi', 'time' => 12.01],
    ];

    /**
     * Array with sorting items
     * ASC time
     * ASC surname
     */
    const SORTED_MULTI_DIMENSION_VER_1 = [
        ['name' => 'Marco', 'surname' => 'Melandri', 'time' => 11.21],
        ['name' => 'Valentino', 'surname' => 'Rossi', 'time' => 11.21],
        ['name' => 'Francesco', 'surname' => 'Bagnaia', 'time' => 11.23],
        ['name' => 'Giacomo', 'surname' => 'Agostini', 'time' => 11.25],
        ['name' => 'Max', 'surname' => 'Biaggi', 'time' => 11.25],
        ['name' => 'Alessandro', 'surname' => 'Tonucci', 'time' => 11.25],
        ['name' => 'Anthony', 'surname' => 'Groppi', 'time' => 11.48],
        ['name' => 'Marco', 'surname' => 'Bezzecchi', 'time' => 12.01],
    ];
    /**
     * Array with sorting items
     * ASC time
     * DESC surname
     */
    const SORTED_MULTI_DIMENSION_VER_2 = [
        ['name' => 'Valentino', 'surname' => 'Rossi', 'time' => 11.21],
        ['name' => 'Marco', 'surname' => 'Melandri', 'time' => 11.21],
        ['name' => 'Francesco', 'surname' => 'Bagnaia', 'time' => 11.23],
        ['name' => 'Alessandro', 'surname' => 'Tonucci', 'time' => 11.25],
        ['name' => 'Max', 'surname' => 'Biaggi', 'time' => 11.25],
        ['name' => 'Giacomo', 'surname' => 'Agostini', 'time' => 11.25],
        ['name' => 'Anthony', 'surname' => 'Groppi', 'time' => 11.48],
        ['name' => 'Marco', 'surname' => 'Bezzecchi', 'time' => 12.01],
    ];

    /**
     * Test create object
     *
     * @return void
     */
    public function testObjectCreate()
    {
        $this->assertInstanceOf(ArraySort::class, new ArraySort([]));
    }

    /**
     * Test getItemsMethod
     *
     * @return void
     */
    public function testGetItemsMethod()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $this->assertTrue(self::NO_SORTED_ARRAY === $instance->getItems());
    }

    /**
     * Test orderBy method with ASC param
     * @throws Exception
     * @return void
     */
    public function testMethodOrderByWithAsc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $instance->orderBy('name', ArraySort::ASC);

        $conditionTable = [
            ['column' => 'name', 'direction' => 1],
        ];

        $this->assertTrue($conditionTable === $instance->getConditions());
    }

    /**
     * Test orderBy method with DESC param
     * @throws Exception
     * @return void
     */
    public function testMethodOrderByWithDesc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $instance->orderBy('name', ArraySort::DESC);

        $conditionTable = [
            ['column' => 'name', 'direction' => 2],
        ];

        $this->assertTrue($conditionTable === $instance->getConditions());
    }

    /**
     * Test asc method
     * @throws Exception
     * @return void
     */
    public function testMethodAsc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $instance->asc('name');

        $conditionTable = [
            ['column' => 'name', 'direction' => 1],
        ];

        $this->assertTrue($conditionTable === $instance->getConditions());
    }

    /**
     * Test desc method
     * @throws Exception
     * @return void
     */
    public function testMethodDesc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $instance->desc('name');

        $conditionTable = [
            ['column' => 'name', 'direction' => 2],
        ];

        $this->assertTrue($conditionTable === $instance->getConditions());
    }

    /**
     * Test return instance orderBy method with ASC direction
     * @throws Exception
     * @return void
     */
    public function testReturnInstanceOrderByMethodWithAsc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $returnInstance = $instance->orderBy('name', ArraySort::ASC);
        $this->assertInstanceOf(ArraySort::class, $returnInstance);
    }

    /**
     * Test return instance orderBy method with DESC direction
     * @throws Exception
     * @return void
     */
    public function testReturnInstanceOrderByMethodWithDesc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $returnInstance = $instance->orderBy('name', ArraySort::DESC);
        $this->assertInstanceOf(ArraySort::class, $returnInstance);
    }

    /**
     * Test return instance asc method
     * @throws Exception
     * @return void
     */
    public function testReturnInstanceAsc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $returnInstance = $instance->asc('name');
        $this->assertInstanceOf(ArraySort::class, $returnInstance);
    }

    /**
     * Test return instance asc method
     * @throws Exception
     * @return void
     */
    public function testReturnInstanceDesc()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $returnInstance = $instance->desc('name');
        $this->assertInstanceOf(ArraySort::class, $returnInstance);
    }


    /**
     * Test method fieldExists, expected true
     *
     * @throws Exception
     * @return void
     */
    public function testFieldExistsMethodReturnTrue()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $this->assertTrue($instance->fieldExists('name'));
    }

    /**
     * Test method fieldExists, expected false
     *
     * @throws Exception
     * @return void
     */
    public function testFieldExistsMethodReturnException()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $this->expectException(Exception::class);
        $instance->fieldExists('other');

    }

    /**
     * Test one dimension
     * ASC time
     *
     * @throws Exception
     * @return void
     */
    public function testOneDimensionSort()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $instance->asc('time')->sort();
        $this->assertTrue($instance->getItems() === self::SORTED_ONE_DIMENSION);
    }

    /**
     * Test multi dimensions versions 1
     * ASC time
     * ASC surname
     *
     * @throws Exception
     * @return void
     */
    public function testMultiDimensionsVer1Sort()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $instance->asc('time')->asc('surname')->sort();
        $this->assertTrue($instance->getItems() === self::SORTED_MULTI_DIMENSION_VER_1);
    }

    /**
     * Test multi dimensions versions 2
     * ASC time
     * DESC surname
     *
     * @throws Exception
     * @return void
     */
    public function testMultiDimensionsVer2Sort()
    {
        $instance = new ArraySort(self::NO_SORTED_ARRAY);
        $instance->asc('time')->desc('surname')->sort();
        $this->assertTrue($instance->getItems() === self::SORTED_MULTI_DIMENSION_VER_2);
    }
}
