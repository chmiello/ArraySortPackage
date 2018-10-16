# Array Sort Package

Light class to sort the multidimensional array in ascending or descending order.

## Install

To install through Composer, by run the following command:

``` bash
composer require chmiello/array-sort
```

Example
-------
```php
<?php

use Chmiello\ArraySortPackage\ArraySort;

$noSortedData = [
    ['name' => 'Giacomo', 'surname' => 'Agostini', 'time' => 11.25],
    ['name' => 'Francesco', 'surname' => 'Bagnaia', 'time' => 11.23],
    ['name' => 'Marco', 'surname' => 'Bezzecchi', 'time' => 12.01],
    ['name' => 'Max', 'surname' => 'Biaggi', 'time' => 11.25],
    ['name' => 'Anthony', 'surname' => 'Groppi', 'time' => 11.48],
    ['name' => 'Valentino', 'surname' => 'Rossi', 'time' => 11.21],
    ['name' => 'Marco', 'surname' => 'Melandri', 'time' => 11.21],
    ['name' => 'Alessandro', 'surname' => 'Tonucci', 'time' => 11.25]
    ];

    $sortedArray = (new ArraySort($noSortedData))->asc('time')->desc('surname')->sort()->getItems();
    
    dump($sortedArray);
?>
```