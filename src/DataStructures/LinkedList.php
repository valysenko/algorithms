<?php

namespace App\DataStructures;

use App\DataStructures\Nodes\KeyValueNode;

/**
 * Class LinkedList
 * @package App\DataStructures
 */
class LinkedList
{
    /**
     * @var KeyValueNode
     */
    private $first;

    /**
     * @var int
     */
    private $size;

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    private function pushToEmpty($key, $value)
    {
        $this->first = new KeyValueNode($key, $value);
        $this->first->setNext(null);
        $this->size++;

        return true;
    }

    /**
     * O(1)
     *
     * @param $key
     * @param $value
     */
    public function push($key, $value)
    {
        if (!$this->first) {
            $this->pushToEmpty($key, $value);
        } else {
            $oldFirst = $this->first;
            $this->first = new KeyValueNode($key, $value);
            $this->first->setNext($oldFirst);
            $this->size++;
        }

    }

    /**
     * O(n)
     *
     * @param $key
     * @return KeyValueNode|mixed
     * @throws \Exception
     */
    public function get($key)
    {
        $curr = $this->first;
        while ($curr) {
            if ($curr->getKey() === $key) {
                return $curr->getValue();
            }
            $curr = $curr->getNext();
        }

        throw new \Exception("Element does not exist");
    }

    /**
     * O(n)
     *
     * @throws \Exception
     */
    public function delete($key)
    {
        $prev = null;
        $curr = $this->first;
        while ($curr) {
            if ($curr->getKey() === $key) {
                $next = $curr->getNext();
                if ($prev) {
                    $prev->setNext($next);
                } else {
                    $this->first = $curr->getNext();
                }
            }

            $prev = $curr;
            $curr = $curr->getNext();
        }

        $this->size--;
    }

}