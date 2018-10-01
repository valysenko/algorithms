<?php

namespace App\Tests\Services\Sorting;

use App\Services\Sorting\InsertionSort;
use PHPUnit\Framework\TestCase;

class InsertionSortTest extends TestCase
{
    public function testSort()
    {
        $insertionSort = new InsertionSort();
        $result = $insertionSort->sort([2,9,7,4,8,1]);

        $this->assertEquals($result, [1,2,4,7,8,9]);
    }

}