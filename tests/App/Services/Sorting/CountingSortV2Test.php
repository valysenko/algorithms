<?php

namespace App\Tests\Services\Sorting;

use App\Services\Sorting\CountingSortV2;
use PHPUnit\Framework\TestCase;

class CountingSortV2Test extends TestCase
{
    public function testSort()
    {
        $countingSort = new CountingSortV2();

        $result = $countingSort->sort([3, -4, 7, -6, 2, 2, 0, 1, 2]);
        $result2 = $countingSort->sort([2, 3, 1, 7, 3]);

        $this->assertEquals($result, [-6, -4, 0, 1, 2, 2, 2, 3, 7]);
        $this->assertEquals($result2, [1, 2, 3, 3, 7]);
    }

}