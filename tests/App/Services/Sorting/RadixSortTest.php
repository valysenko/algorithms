<?php

namespace App\Tests\Services\Sorting;

use App\Services\Sorting\RadixSort;
use PHPUnit\Framework\TestCase;

class RadixSortTest extends TestCase
{
    public function testSort()
    {
        $radixSort = new RadixSort();

        $a = [24, 753, -11, 11, 13, -290];
        $b = [100, 10, 350, -1, 770, 0, 355];
        $c = [142, 59, 113, 120, 119, 850];
        $d = [78, -560, -12, 40,-756 ];

        $radixSort->sort($a);
        $radixSort->sort($b);
        $radixSort->sort($c);
        $radixSort->sort($d);

        $this->assertEquals($a, [-290, -11, 11, 13, 24, 753]);
        $this->assertEquals($b, [-1, 0, 10, 100, 350, 355, 770]);
        $this->assertEquals($c, [59, 113, 119, 120, 142, 850]);
        $this->assertEquals($d, [-756, -560, -12, 40, 78]);
    }

}