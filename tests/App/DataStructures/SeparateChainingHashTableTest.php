<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\SeparateChainingHashTable;
use PHPUnit\Framework\TestCase;

class SeparateChainingHashTableTest extends TestCase
{
    public function testMethods()
    {
        $ht = new SeparateChainingHashTable();
        $ht->insert("abc", 123);
        $ht->insert("cba", 321);
        $ht->insert("g", 34);
        $ht->insert("gt", 55);

        $this->assertEquals($ht->getSize(), 4);
        $ht->delete("gt");
        $this->assertEquals($ht->getSize(), 3);
        $this->assertEquals($ht->get("abc"), 123);
    }

    public function testElementDoesNotExistOnDeleteException()
    {
        $ht = new SeparateChainingHashTable();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Element does not exist');
        $ht->delete(1);
    }

    public function testElementDoesNotExistOnGetException()
    {
        $ht = new SeparateChainingHashTable();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Element does not exist');
        $ht->get(1);
    }

}