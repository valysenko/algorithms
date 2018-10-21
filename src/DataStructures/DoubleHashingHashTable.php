<?php

namespace App\DataStructures;

/**
 * HashTable, based on Open addressing (double hashing implementation) collision resolution
 *
 * Better than Linear probing implementation because of less clustering
 * Interval between probes is computed by a second hash function
 * Number of sequences (attempts to insert an element) = n^2
 *
 * Class DoubleHashingHashTable
 * @package App\DataStructures\
 */
class DoubleHashingHashTable extends OpenAddressingHashTable
{

    /**
     * Hash function based on Division method
     * => k mod m,
     *
     * @param $key
     * @return mixed
     */
    private function hash1($key)
    {
        return $key % $this->limit;
    }

    /**
     * Hash function based on modified Division method
     * => 1 + (k mod m'),
     * m' = m - 1
     *
     * @param $key
     * @return mixed
     */
    private function hash2($key)
    {
        $m = $this->limit - 1;
        return 1 + ($key % $m);
    }

    /**
     * Hash function for double hashing
     * => offset = ($i * $this->hash2($key))
     *
     * @param $key
     * @param $i
     * @return mixed
     */
    protected function hash($key, $i)
    {
        return ( $this->hash1($key) + ($i * $this->hash2($key)) ) % $this->limit;
    }

}