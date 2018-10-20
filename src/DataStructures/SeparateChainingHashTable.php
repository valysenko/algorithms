<?php

namespace App\DataStructures;


use App\DataStructures\Nodes\KeyValueNode;

/**
 * HashTable, based on separate chaining collision resolution
 *
 *  key1 and key2 have similar value of hash-function
 * [ hash1 => LinkedList {key1 => val , key2 => val2 },
 *   hash2 => ListList {key3 => val3 }
 * ]
 *
 * Class SeparateChainingHashTable
 * @package App\DataStructures
 */
class SeparateChainingHashTable
{
    /**
     * @var array|KeyValueNode
     */
    private $elements;

    /**
     * @var int
     */
    private $size;

    /**
     * SeparateChainingHashTable constructor.
     */
    public function __construct()
    {
        $this->elements = [];
        $this->size = 0;
    }


    /**
     * @param $key
     * @return mixed
     */
    private function hash($key)
    {
        return hash('sha1',$key);
    }

    /**
     * O(1)
     * Insert element to the head of list with hash(key)
     *
     * @param $key
     * @param $value
     */
    public function insert($key, $value)
    {
        $this->size++;
        $hash = $this->hash($key);
        if (array_key_exists($hash, $this->elements) && $this->elements[$hash] instanceof LinkedList) {
            $this->elements[$hash]->push($key, $value);
        } else {
            $list = new LinkedList();
            $list->push($key, $value);
            $this->elements[$hash] = $list;
        }
    }

    /**
     * O(1)
     *
     * @param $key
     * @throws \Exception
     */
    public function delete($key)
    {
        $hash = $this->hash($key);
        if (array_key_exists($hash, $this->elements) && $this->elements[$hash] instanceof LinkedList) {
            $this->elements[$hash]->delete($key);
            $this->size--;
        } else {
            throw new \Exception("Element does not exist");
        }
    }

    /**
     * O(1) - successful search
     *
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public function get($key)
    {
        $hash = $this->hash($key);
        if (array_key_exists($hash, $this->elements) && $this->elements[$hash] instanceof LinkedList) {
            return $this->elements[$hash]->get($key);
        } else {
            throw new \Exception("Element does not exist");
        }
    }

    public function el()
    {
       dump($this->elements); die;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

}