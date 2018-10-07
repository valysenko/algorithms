<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testMethods()
    {
        $queue = new Queue(3);
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);

        $this->assertEquals($queue->dequeue(), 1);
        $this->assertEquals($queue->dequeue(), 2);
        $this->assertEquals($queue->dequeue(), 3);
    }

    public function testFullQueueException()
    {
        $queue = new Queue(1);
        $queue->enqueue(1);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Queue is full');
        $queue->enqueue(2);
    }

    public function testEmptyQueueException()
    {
        $queue = new Queue(1);
        $queue->enqueue(1);
        $queue->dequeue();

        $this->expectExceptionMessage('Queue is empty');
        $queue->dequeue();
    }

}