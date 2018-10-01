<?php

namespace App\Tests\Services\Sorting;

use App\Services\Sorting\MergeSortV1;
use App\Services\Sorting\MergeSortV2;
use PHPUnit\Framework\TestCase;

class MergeSortV2Test extends TestCase
{
    public function testSort()
    {
        $mergeSort = new MergeSortV2();
        $a = [2, 9, 7, 4, 8, 1, 11, 4];
        $mergeSort->sort($a, 0, 7);

        $this->assertEquals($a, [1, 2, 4, 4, 7, 8, 9, 11]);
    }

}