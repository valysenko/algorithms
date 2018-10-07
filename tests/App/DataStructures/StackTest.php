<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Stack;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testMethods()
    {
        $stack = new Stack(3);
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $this->assertEquals($stack->pop(), 3);
        $this->assertEquals($stack->pop(), 2);
        $this->assertEquals($stack->pop(), 1);

    }

    public function testFullStackException()
    {
        $stack = new Stack(1);
        $stack->push(1);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Stack is full');
        $stack->push(2);
    }

    public function testEmptyStackException()
    {
        $stack = new Stack(1);
        $stack->push(1);
        $stack->pop();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Stack is empty');
        $stack->pop();
    }

}