<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\LinkedQueue;
use App\DataStructures\Queue;
use PHPUnit\Framework\TestCase;

class LinkedQueueTest extends TestCase
{
    public function testMethods()
    {
        $queue = new LinkedQueue();
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);

        $this->assertEquals($queue->dequeue()->getItem(), 1);
        $this->assertEquals($queue->dequeue()->getItem(), 2);
        $this->assertEquals($queue->dequeue()->getItem(), 3);
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