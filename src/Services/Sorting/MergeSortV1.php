<?php

namespace App\Services\Sorting;

/**
 * Class MergeSortV1
 * @package App\Services\Sorting
 *
 * Merge sort - returns sorted copy of input array
 * O(n(log(n)))
 */
class MergeSortV1
{

    /**
     * @param $left
     * @param $right
     * @return array
     */
    private function merge(array $left, array $right): array
    {
        $result = [];
        $l = 0;
        $r = 0;

        while ($l < count($left) && $r < count($right)) {
            if ($left[$l] < $right[$r]) {
                $result[] =  $left[$l];
                $l++;
            }
            else {
                $result[] =  $right[$r];
                $r++;
            }
        }

        // if elements left in left or right part => copy this elements to the result
        for($z = $r; $z < count($right); $z ++) {
            $result[] =  $right[$r];
            $r++;
        }
        for($z = $l; $z < count($left); $z ++) {
            $result[] =  $left[$l];
            $l++;
        }

        return $result;
    }

    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        if (count($array) >1) {
            $mid = count($array) / 2;
            $sortedLeft = $this->sort(array_slice($array, 0, $mid));
            $sortedRight = $this->sort(array_slice($array, $mid));

            return $this->merge($sortedLeft, $sortedRight);
        }

        return $array;
    }

}