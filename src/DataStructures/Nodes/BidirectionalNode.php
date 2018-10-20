<?php

namespace App\DataStructures\Nodes;


class BidirectionalNode
{
    /**
     * @var mixed
     */
    private $item;

    /**
     * @var mixed
     */
    private $prev;

    /**
     * @var mixed
     */
    private $next;

    /**
     * Node constructor.
     * @param mixed $item
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param mixed $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * @return mixed
     */
    public function getPrev(): ?BidirectionalNode
    {
        return $this->prev;
    }

    /**
     * @param mixed $prev
     */
    public function setPrev($prev)
    {
        $this->prev = $prev;
    }

    /**
     * @return mixed
     */
    public function getNext(): ?BidirectionalNode
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

}