<?php

namespace App\DataStructures;


class Node
{
    /**
     * @var mixed
     */
    private $item;


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
    public function getNext(): ?Node
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