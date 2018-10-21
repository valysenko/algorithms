<?php

namespace App\DataStructures;

/**
 * HashTable, based on Open addressing (linear probing implementation) collision resolution
 *
 * Problem: clustering of hash values (long sequences of occupied cells) - increases the average search time
 * Interval between probes is 1
 * Number of sequences (attempts to insert an element) = m!
 *
 * Class LinearProbingHashTable
 * @package App\DataStructures
 */
class LinearProbingHashTable extends OpenAddressingHashTable
{

    /**
     * Hash function based on Multiplication method
     * => ⌊N*({k*A})⌋,
     * 0<A<1,
     * ⌊⌋ - the whole part,
     * {} - fraction
     *
     * => offset = 1
     *
     * @param $key
     * @param $i
     * @return mixed
     */
    protected function hash($key, $i)
    {
        $A = 0.618034;
        $kA = $key * $A;
        return intval($this->limit * ($kA - intval($kA)) ) + $i;
    }

}