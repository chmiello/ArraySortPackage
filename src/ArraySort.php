<?php

namespace Chmiello\ArraySortPackage;

use phpDocumentor\Reflection\Types\Boolean;

/**
 * Sorting multidimensional array in PHP
 *
 * Class ArraySort
 *
 * @category PHP
 * @package  Chmiello\ArraySortPackage
 * @author   chmiello <bartek@chmiello.pl>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/chmiello/ArraySortPackage
 */
class ArraySort
{

    const ASC = 1;
    const DESC = 2;

    /**
     * Array items
     *
     * @var array
     */
    private $_items;

    /**
     * Sort conditions
     *
     * @var array
     */
    private $_conditions = [];

    /**
     * ArraySort constructor.
     *
     * @param array $array - no sorted array
     */
    public function __construct(array $array)
    {
        $this->_items = $array;
    }

    /**
     * Return all items
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->_items;
    }

    /**
     * Return all conditions
     *
     * @return array
     */
    public function getConditions(): array
    {
        return $this->_conditions;
    }


    /**
     * Add a sort order condition
     *
     * @param string $column    field in array
     * @param string $direction 1 - asc | 2 - desc
     *
     * @throws \Exception
     * @return ArraySort
     */
    public function orderBy(string $column, $direction): ArraySort
    {
        $this->fieldExists($column);
        $this->_conditions[] = ['column' => $column, 'direction' => $direction];
        return $this;
    }

    /**
     * Alias orderBy(?, 'asc')
     *
     * @param string $column - field in array
     *
     * @throws \Exception
     * @return ArraySort
     */
    public function asc($column): ArraySort
    {
        return $this->orderBy($column, self::ASC);
    }

    /**
     * Alias orderBy(?, 'desc')
     *
     * @param string $column - field in array
     *
     * @throws \Exception
     * @return ArraySort
     */
    public function desc($column): ArraySort
    {
        return $this->orderBy($column, self::DESC);
    }

    /**
     * Dump items
     *
     * @return void
     */
    public function ddItems(): void
    {
        dump($this->getItems());
    }

    /**
     * Check that exists field in array
     *
     * @param string $fieldName Array field name
     *
     * @throws \Exception
     * @return bool
     */
    public function fieldExists(string $fieldName): bool
    {
        foreach ($this->_items as $index => $item) {
            if (!isset($item[$fieldName])) {
                throw new \Exception($index . ': has no field ' . $fieldName);
            }
        }

        return true;
    }
}