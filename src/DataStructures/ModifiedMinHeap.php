<?php

namespace App\DataStructures;

/**
 * Class ModifiedMinHeap
 *  - is used in the improved Dijkstra algorithm
 *
 * @package App\DataStructures
 */
class ModifiedMinHeap extends BaseHeap
{

    /**
     * @param $element
     * @return int|null
     */
    public function getPosition($element)
    {
        for ($i = 0; $i < $this->elements; $i++) {
            //  TODO: refactor
            if ($this->elements[$i]->getVertex() == $element) {
                return $i;
            }
        }

        return null;
    }

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

        if ($x < $arraySize && $l < $actualHeapSize && isset($this->elements[$l]) && $this->elements[$l]->compareTo($this->elements[$x]) < 0) {
            $smallest = $l;
        } else {
            $smallest = $x;
        }

        if ($x < $arraySize && $r < $actualHeapSize &&isset($this->elements[$r]) && $this->elements[$r]->compareTo($this->elements[$smallest]) < 0) {
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
        $min = $this->elements[0];
        $this->elements[0] = array_pop($this->elements);
        $this->heapify(0);

        return $min;
    }

    /**
     * O(log(n))
     *
     * @param $element
     * @param null $currentPosition
     */
    public function fixPosition($element, $currentPosition = null)
    {
        if (!$currentPosition) {
            $currentPosition = $this->getPosition($element);
        }

        while ($currentPosition > 0 && $this->elements[$this->parentIndex($currentPosition)]->getWeight() > $this->elements[$currentPosition]->getWeight()) {
            $parentPosition = $this->parentIndex($currentPosition);
            $this->exch($currentPosition, $parentPosition);
            $currentPosition = $this->parentIndex($currentPosition);
        }
    }


    /**
     * O(log(n))
     *
     * @param $element
     */
    public function insert($element)
    {
        $this->elements[] = $element;
        $this->fixPosition($element, $this->size() -1);
    }



}