<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\BidirectionalLinkedList;
use PHPUnit\Framework\TestCase;

class BidirectionalLinkedListTest extends TestCase
{
    public function testMethods()
    {
        $list = new BidirectionalLinkedList();
        $list->pushToEnd(1);
        $list->pushToEnd(2);
        $list->pushToStart(4);
        $list->pushToStart(3);

        $first = $list->getFirst();
        $last = $list->getLast();

        $this->assertEquals($first->getItem(), 3);
        $this->assertEquals($last->getItem(), 2);

        $list->pushByPosition(-10, 0);
        $list->pushByPosition(10, 5);

//      -10 3 4 1 2 10 -> -10 3 5 4 1 2 10
        $list->pushByPosition(5, 3);
        $elem = $list->getElementByPosition(3);
        $size = $list->getSize();

        $this->assertEquals($size, 7);
        $this->assertEquals($elem->getItem(), 5);

        $list->removeFirst();
        $list->removeLast();
        $list->removeByValue(5);
        $list->removeByPosition(2);
        $list->removeFirst();
        $list->removeFirst();
        $list->removeFirst();

        $this->assertEquals($list->getSize(), 0);

    }

    public function testWrongPositionPushException()
    {
        $list = new BidirectionalLinkedList();
        $list->pushToEnd(1);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Wrong position');
        $list->pushByPosition(2, 2);
    }

    public function testWrongPositionRemoveException()
    {
        $list = new BidirectionalLinkedList();
        $list->pushToEnd(1);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Wrong position');
        $list->removeByPosition(2);
    }

    public function testWrongPositionGetException()
    {
        $list = new BidirectionalLinkedList();
        $list->pushToEnd(1);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Wrong position');
        $list->getElementByPosition(2);
    }

    public function testEmptyList()
    {
        $list = new BidirectionalLinkedList();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('List is empty');
        $list->removeFirst();
    }

}