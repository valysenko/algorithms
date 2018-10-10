<?php

namespace App\DataStructures;

/**
 * Class MaxHeap
 * @package App\DataStructures
 */
class MaxHeap
{
    /**
     * @var array
     */
    private $elements;

    /**
     * @param int $i
     * @param int $j
     */
    private function exch(int $i, int $j)
    {
       $temp = $this->elements[$i];
       $this->elements[$i] = $this->elements[$j];
       $this->elements[$j] = $temp;
    }

    /**
     * @param $index
     * @return int
     */
    private function parentIndex(int $index): int
    {
        return intdiv($index, 2);
    }

    /**
     * @param $index
     * @return int
     */
    private function leftChildIndex(int $index): int
    {
        return 2 * $index + 1;
    }

    /**
     * @param $index
     * @return int
     */
    private function rightChildIndex(int $index): int
    {
        return 2 * $index + 2;
    }

    /**
     * O(log(n))
     *
     *    (i)
     * (l)   (r)
     *
     * => Method restores max heap properties: (i)>(l) and (i)>(r)
     *
     * @param int $x - position of current element
     * @param int $n - number of not used array elements in the heap (for sorting)
     */
    private function heapify(int $x, int $n = 0)
    {
        $l = $this->leftChildIndex($x);
        $r = $this->rightChildIndex($x);
        $arraySize = $this->size();
        $actualHeapSize = $arraySize - $n;

        if ($x < $arraySize && $l < $actualHeapSize && isset($this->elements[$l]) && $this->elements[$l] > $this->elements[$x]) {
            $largest = $l;
        } else {
            $largest = $x;
        }

        if ($x < $arraySize && $r < $actualHeapSize &&isset($this->elements[$r]) && $this->elements[$r] > $this->elements[$largest]) {
            $largest = $r;
        }

        if ($largest != $x) {
            $this->exch($x, $largest);
            $this->heapify($largest, $n);
        }

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
     *  O(log(n))
     *
     * @return mixed
     * @throws \Exception
     */
    public function extractMax()
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
        while ($position > 0 && $this->elements[$this->parentIndex($position)] < $this->elements[$position]) {
            $parentPosition = $this->parentIndex($position);
            $this->exch($position, $parentPosition);
            $position = $this->parentIndex($position);
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

    /**
     * O(n*log(n))
     *
     * @return array
     */
    public function sort(array $elements = []): array
    {
        $this->build($elements);
        for ($i = $this->size() -1, $n = 1; $i > 0; $i--, $n++) {
            // exchange first (maximum) element with last
            $this->exch($i, 0);
            // move maximum element of actual part of heap array to the top
            $this->heapify(0, $n);
        }

        return $this->elements;
    }

}