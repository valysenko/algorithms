<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\SimpleBinaryTree;
use PHPUnit\Framework\TestCase;

class SimpleBinaryTreeTest extends TestCase
{

    /**
     * @var SimpleBinaryTree
     */
    protected static $tree;

    protected function setUp()
    {
        self::$tree = new SimpleBinaryTree();
        self::$tree->insert(10);
        self::$tree->insert(7);
        self::$tree->insert(14);
        self::$tree->insert(4);
        self::$tree->insert(8);
        self::$tree->insert(11);
        self::$tree->insert(12);
        self::$tree->insert(19);
        self::$tree->insert(20);
    }

    public function testMethods()
    {
        $this->assertEquals(self::$tree->getSize(), 9);
        $this->assertEquals(self::$tree->min()->getValue(), 4);
        $this->assertEquals(self::$tree->max()->getValue(), 20);

        $root = self::$tree->getRoot();
        $node1 = self::$tree->iterativeSearch(8);
        $node2 = self::$tree->search(10, $root);

        $this->assertEquals($node1->getValue(), 8);
        $this->assertEquals($node2->getValue(), 10);

        $node1Next = self::$tree->next($node1);
        $node2Next = self::$tree->next($node2);

        $this->assertEquals($node1Next->getValue(), 10);
        $this->assertEquals($node2Next->getValue(), 11);

    }

    public function testDeleteMethod()
    {
        self::$tree->delete(10);
        self::$tree->delete(14);
        self::$tree->delete(7);
        self::$tree->delete(8);
        self::$tree->delete(4);

        $this->assertEquals(self::$tree->getSize(), 4);
        $this->assertEquals(self::$tree->min()->getValue(), 11);
        $this->assertEquals(self::$tree->max()->getValue(), 20);

        self::$tree->delete(11);
        self::$tree->delete(20);
        self::$tree->delete(12);
        self::$tree->delete(19);
        $this->assertEquals(self::$tree->getSize(), 0);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Element not found');
        self::$tree->delete(3);
    }

    public function testSpecialCasesMethod()
    {
        $tree = new SimpleBinaryTree();
        $a = $tree->search(1);
        $b = $tree->search(2);

        $this->assertEquals($a, null);
        $this->assertEquals($b, null);
    }

    public function testInOrderTreeWalkGeneratorMethod()
    {
        $check = [4, 7, 8, 10, 11, 12, 14, 19, 20];
        foreach (self::$tree->inOrderWalkGenerator() as $item) {
            $this->assertEquals($item->getValue(), array_shift($check));
        }
    }

}