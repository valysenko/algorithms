<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\LinearProbingHashTable;
use PHPUnit\Framework\TestCase;

class LinearProbingHashTableTest extends TestCase
{
    public function testMethods()
    {
        $ht = new LinearProbingHashTable(10);
        $ht->insert(5);
        $ht->insert(0);
        $ht->insert(15);
        $ht->insert(25);

        $this->assertEquals($ht->getSize(), 4);
        $ht->delete(5);
        $this->assertEquals($ht->getSize(), 3);
        $this->assertEquals($ht->exists(15), true);
        $this->assertEquals($ht->exists(5), false);
    }

    public function testIsFullException()
    {
        $ht = new LinearProbingHashTable(3);
        $ht->insert(1);
        $ht->insert(2);
        $ht->insert(3);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('HashTable is full');
        $ht->insert(4);
    }


}