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
     * Array items
     *
     * @var array
     */
    private $_items;

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
     * Dump items
     *
     * @return void
     */
    public function ddItems()
    {
        dump($this->getItems());
    }
}