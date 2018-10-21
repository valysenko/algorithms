<?php

namespace App\DataStructures;

/**
 * HashTable, based on Open addressing
 * 
 * abstract Class OpenAddressingHashTable
 * abstract method - hash(key,i)
 *
 * @package App\DataStructures
 */
abstract class OpenAddressingHashTable
{
    /**
     * @var array
     */
    protected $elements;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var int
     */
    protected $limit;

    /**
     *
     * @param $key
     * @param $i
     * @return mixed
     */
    abstract protected function hash($key, $i);

    /**
     * Prevent index out of bounds
     *
     * @param $key
     * @param $i
     * @return mixed
     */
    protected function position($key, $i) {
        $j = $this->hash($key, $i);
        if ($j >= $this->limit) {
            $j-=$this->limit;
        }

        return $j;
    }


    /**
     * OpenAddressingHashTable constructor.
     * @param int $limit
     */
    public function __construct($limit)
    {
        $this->size = 0;
        $this->limit = $limit;
        for ($i = 0; $i < $limit; $i++) {
            $this->elements[$i] = null;
        }
    }

    /**
     * @param $key
     * @return int
     * @throws \Exception
     */
    public function insert($key)
    {
        if ($this->size === $this->limit) {
            throw new \Exception('HashTable is full');
        }

        // probe
        $i = 0;
        while ($i < $this->limit) {
            // get hash (array index) and fix if index is greater than array limit
            $j = $this->position($key, $i);
            if (!$this->elements[$j]) {
                $this->elements[$j] = $key;
                $this->size++;
                return $i;
            } else {
                // try to insert element in next probe
                $i++;
            }
        }
    }


    /**
     * @param $key
     * @return bool
     */
    public function exists($key)
    {
        for ($i = 0; $i < $this->limit; $i++) {
            $j = $this->position($key, $i);
            $elem = $this->elements[$j];
            if ($elem && $elem === $key) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        for ($i = 0; $i < $this->limit; $i++) {
            $j = $this->position($key, $i);
            $elem = $this->elements[$j];
            if ($elem && $elem === $key) {
                $this->elements[$j] = null;
                $this->size--;

                return true;
            }
        }
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

}