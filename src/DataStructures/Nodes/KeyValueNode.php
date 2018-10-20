<?php

namespace App\DataStructures\Nodes;


class KeyValueNode
{

    /**
     * @var mixed
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;


    /**
     * @var mixed
     */
    private $next;

    /**
     * KeyValueNode constructor.
     * @param $key
     * @param $value
     *
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getNext():?KeyValueNode
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