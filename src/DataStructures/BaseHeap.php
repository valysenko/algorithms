<?php

namespace App\DataStructures;

/**
 * Class BaseHeap
 * @package App\DataStructures
 */
abstract class BaseHeap
{
    /**
    * @var array
    */
    protected $elements;

    /**
     * @param int $x
     * @param int $n
     */
    abstract protected function heapify(int $x, int $n = 0);

    /**
     * @param $element
     */
    abstract protected  function insert($element);

    /**
     * @param int $i
     * @param int $j
     */
    protected function exch(int $i, int $j)
    {
        $temp = $this->elements[$i];
        $this->elements[$i] = $this->elements[$j];
        $this->elements[$j] = $temp;
    }

    /**
     * @param $index
     * @return int
     */
    protected function parentIndex(int $index): int
    {
        return intdiv($index, 2);
    }

    /**
     * @param $index
     * @return int
     */
    protected function leftChildIndex(int $index): int
    {
        return 2 * $index + 1;
    }

    /**
     * @param $index
     * @return int
     */
    protected function rightChildIndex(int $index): int
    {
        return 2 * $index + 2;
    }


    /**
     * O(n*log(n))
     *
     * @param array $elements
     */
    public function build($elements = [])
    {
        $this->elements = $elements;
        for ($i = intdiv($this->size(), 2) -1; $i >= 0; $i--) {
            $this->heapify($i);
        }
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @return int
     */
    public function size()
    {
        return count($this->elements);
    }

}