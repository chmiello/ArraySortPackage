<?php

namespace Chmiello\ArraySortPackage;

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

    /**
     * Ascending
     */
    const ASC = 1;

    /**
     * Descending
     */
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

    /**
     * Sort call
     *
     * @return $this
     */
    public function sort()
    {
        $this->_items = $this->_sortRecursively();
        return $this;
    }

    /**
     * Recursive sorting method
     *
     * @param array|null $conditions Array with conditions
     * @param array|null $items      Items
     * @param bool       $repeat     repeated call
     *
     * @return array
     */
    private function _sortRecursively($conditions = null, $items = null, $repeat = false)
    {
        if (is_null($conditions)) {
            $conditions = $this->_conditions;
        }

        if (is_null($items)) {
            $items = $this->_items;
        }

        foreach ($conditions as $conditionItem) {
            $tmpArrayValue = [];
            foreach ($items as $item) {
                $key = (string)$item[$conditionItem['column']];
                if (!isset($tmpArrayValue[$key])) {
                    $tmpArrayValue[$key] = [];
                }
                $tmpArrayValue[$key][] = $item;
            }

            if ($conditionItem['direction'] == self::ASC) {
                ksort($tmpArrayValue);
            } else {
                krsort($tmpArrayValue);
            }

            $newConditions = array_slice($conditions, 1);
            if (count($newConditions)) {
                foreach ($tmpArrayValue as $index => $newItems) {
                    $tmpArrayValue[$index] = $this->_sortRecursively($newConditions, $newItems, true);
                }
            }
            if ($repeat) {
                return $tmpArrayValue;
            } else {
                return $this->_flatArray($tmpArrayValue);
            }
        }

        return [];
    }


    /**
     * Flattening the array after sorting
     *
     * @param array $array sorted array
     * @param int   $level level of nesting
     *
     * @return array
     */
    private function _flatArray(array $array, int $level = 0)
    {
        if ($level == count($this->_conditions)) {
            return $array;
        }

        $sorted = [];

        foreach ($array as $index => $item) {
            $sorted = array_merge($sorted, $this->_flatArray($item, $level + 1));
        }

        return $sorted;
    }
}