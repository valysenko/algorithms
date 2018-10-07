<?php

namespace App\DataStructures;

class Stack
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
    public function push($item)
    {
        if ($this->limit > count($this->elements)) {
            $this->elements[] = $item;
        } else {
            throw new \Exception('Stack is full');
        }
    }

    /**
     * O(1)
     *
     * @return mixed
     * @throws \Exception
     */
    public function pop()
    {
        if (count($this->elements) > 0) {
            return array_pop($this->elements);
        }
        throw new \Exception('Stack is empty');
    }

}