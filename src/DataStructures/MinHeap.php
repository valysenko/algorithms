<?php

namespace App\DataStructures;

/**
 * Class MinHeap
 * @package App\DataStructures
 */
class MinHeap extends BaseHeap
{

    /**
     * O(log(n))
     *
     *    (i)
     * (l)   (r)
     *
     * => Method restores min heap properties: (i)<(l) and (i)<(r)
     *
     * @param int $x - position of current element
     * @param int $n - number of not used array elements in the heap (for sorting)
     */
    protected function heapify(int $x, int $n = 0)
    {
        $l = $this->leftChildIndex($x);
        $r = $this->rightChildIndex($x);
        $arraySize = $this->size();
        $actualHeapSize = $arraySize - $n;

        if ($x < $arraySize && $l < $actualHeapSize && isset($this->elements[$l]) && $this->elements[$l] < $this->elements[$x]) {
            $smallest = $l;
        } else {
            $smallest = $x;
        }

        if ($x < $arraySize && $r < $actualHeapSize &&isset($this->elements[$r]) && $this->elements[$r] < $this->elements[$smallest]) {
            $smallest = $r;
        }

        if ($smallest != $x) {
            $this->exch($x, $smallest);
            $this->heapify($smallest, $n);
        }

    }



    /**
     *  O(log(n))
     *
     * @return mixed
     * @throws \Exception
     */
    public function extractMin()
    {
        if ($this->size() === 0) {
            throw new \Exception('Heap is empty');
        }
        if ($this->size() === 1) {
            return array_pop($this->elements);
        }
        $max = $this->elements[0];
        $this->elements[0] = array_pop($this->elements);
        $this->heapify(0);

        return $max;
    }

    /**
     * O(log(n))
     *
     * @param $element
     */
    public function insert($element)
    {
        $this->elements[] = $element;
        $position = $this->size() -1;
        while ($position > 0 && $this->elements[$this->parentIndex($position)] > $this->elements[$position]) {
            $parentPosition = $this->parentIndex($position);
            $this->exch($position, $parentPosition);
            $position = $this->parentIndex($position);
        }
    }

    /**
     * descending order
     * O(n*log(n))
     *
     * @return array
     */
    public function sort(array $elements = []): array
    {
        $this->build($elements);
        for ($i = $this->size() -1, $n = 1; $i > 0; $i--, $n++) {
            // exchange first (minimum) element with last
            $this->exch($i, 0);
            // move maximum element of actual part of heap array to the top
            $this->heapify(0, $n);
        }

        return $this->elements;
    }

}