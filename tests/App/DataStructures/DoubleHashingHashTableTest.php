<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\DoubleHashingHashTable;
use PHPUnit\Framework\TestCase;

class DoubleHashingHashTableTest extends TestCase
{
    public function testMethods()
    {
        $ht = new DoubleHashingHashTable(10);
        $ht->insert(5);
        $ht->insert(0);
        $ht->insert(15);
        $ht->insert(25);
        $ht->insert(42);
        $ht->insert(55);
        $ht->insert(66);

        $this->assertEquals($ht->getSize(), 7);
        $ht->delete(5);
        $this->assertEquals($ht->getSize(), 6);
        $this->assertEquals($ht->exists(15), true);
        $this->assertEquals($ht->exists(5), false);
    }

    public function testIsFullException()
    {
        $ht = new DoubleHashingHashTable(3);
        $ht->insert(1);
        $ht->insert(2);
        $ht->insert(3);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('HashTable is full');
        $ht->insert(4);
    }


}