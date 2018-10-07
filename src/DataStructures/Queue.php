<?php

namespace App\DataStructures;

class Queue
{
    /**
     * @var array
     */
    private $elements;

    /**
     * @var int
     */
    private $limit;

    /**
     * Stack constructor.
     * @param int $limit
     */
    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * O(1)
     *
     * @param $item
     * @throws \Exception
     */
    public function enqueue($item)
    {
        if ($this->limit > count($this->elements)) {
            $this->elements[] = $item;
        } else {
            throw new \Exception('Queue is full');
        }
    }

    /**
     * O(n)
     *
     * @return mixed
     * @throws \Exception
     */
    public function dequeue()
    {
        if (count($this->elements) > 0) {
            return array_shift($this->elements);
        }
        throw new \Exception('Queue is empty');
    }

}