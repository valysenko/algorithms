<?php

namespace App\Tests\Services\Sorting;

use App\Services\Sorting\MergeSortV1;
use App\Services\Sorting\QuickSort;
use PHPUnit\Framework\TestCase;

class QuickSortTest extends TestCase
{
    public function testSort()
    {
        $quickSort = new QuickSort();
        $array = [2,9,7,4,8,1];
        $quickSort->sort($array,0 , 5);

        $this->assertEquals($array, [1,2,4,7,8,9]);
    }

}