<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\MaxHeap;
use PHPUnit\Framework\TestCase;

class MaxHeapTest extends TestCase
{
    public function testMethods()
    {
        $heap = new MaxHeap();
        $heap->build([3,5,10,1,8,7]);
        $this->assertEquals($heap->extractMax(), 10);
        $heap->insert(11);
        $this->assertEquals($heap->extractMax(), 11);
    }

    public function testEmptyHeapException()
    {
        $heap = new MaxHeap();
        $heap->build([8,7,19]);
        $heap->extractMax();
        $heap->extractMax();
        $heap->extractMax();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Heap is empty');
        $heap->extractMax();
    }

    public function testSort()
    {
        $heap = new MaxHeap();
        $sorted = $heap->sort([11,20,3,2,16,9,10,10]);
        $this->assertEquals($sorted, [2,3,9,10,10,11,16,20]);
    }

}