<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\MinHeap;
use PHPUnit\Framework\TestCase;

class MinHeapTest extends TestCase
{
    public function testMethods()
    {
        $heap = new MinHeap();
        $heap->build([5,2,8,6,1,9,10]);
        $this->assertEquals($heap->extractMin(), 1);
        $this->assertEquals($heap->extractMin(), 2);
        $this->assertEquals($heap->extractMin(), 5);
        $heap->insert(3);
        $this->assertEquals($heap->extractMin(), 3);
    }

    public function testEmptyHeapException()
    {
        $heap = new MinHeap();
        $heap->build([1]);
        $heap->extractMin();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Heap is empty');
        $heap->extractMin();
    }

    public function testSort()
    {
        $heap = new MinHeap();
        $sorted = $heap->sort([6,3,5,1]);
        $this->assertEquals($sorted, [6,5,3,1]);
    }

}