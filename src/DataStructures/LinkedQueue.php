<?php

namespace App\DataStructures;

use App\DataStructures\Nodes\Node;

class LinkedQueue
{
    /**
     * @var Node
     */
    private $first;

    /**
     * @var Node
     */
    private $last;

    /**
     * @var int
     */
    private $size;

    /**
     * @return bool
     */
    private function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * O(1)
     *
     * @param $item
     * @throws \Exception
     */
    public function enqueue($item)
    {
        $oldLast = $this->last;
        $this->last = new Node($item);
        $this->last->setNext(null);
        if ($this->isEmpty()) {
            $this->first = $this->last;
        } else {
            $oldLast->setNext($this->last);
        }

        $this->size++;
    }

    /**
     * O(1)
     *
     * @return Node
     * @throws \Exception
     */
    public function dequeue(): Node
    {
        if ($this->size > 0) {
            $oldFirst = $this->first;
            if ($this->size === 1) {
                $this->first = null;
                $this->last = null;
            } else {
                $oldFirst = $this->first;
                $this->first = $oldFirst->getNext();
            }
            $this->size--;

            return $oldFirst;
        }
        throw new \Exception('Queue is empty');
    }

}