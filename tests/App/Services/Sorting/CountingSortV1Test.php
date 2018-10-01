<?php

namespace App\Tests\Services\Sorting;

use App\Services\Sorting\CountingSortV1;
use PHPUnit\Framework\TestCase;

class CountingSortV1Test extends TestCase
{
    public function testSort()
    {
        $countingSort = new CountingSortV1();
        $result = $countingSort->sort([5, 5, 0, 2, 4, 9, 1, 0, 7]);

        $this->assertEquals($result, [0, 0, 1, 2, 4, 5, 5, 7, 9]);
    }

}