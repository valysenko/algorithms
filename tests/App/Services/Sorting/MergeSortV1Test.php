<?php

namespace App\Tests\Services\Sorting;

use App\Services\Sorting\MergeSortV1;
use PHPUnit\Framework\TestCase;

class MergeSortV1Test extends TestCase
{
    public function testSort()
    {
        $mergeSort = new MergeSortV1();
        $result = $mergeSort->sort([2, 9, 7, 4, 8, 1, 11, 4]);

        $this->assertEquals($result, [1, 2, 4, 4, 7, 8, 9, 11]);
    }

}