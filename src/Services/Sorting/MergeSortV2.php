<?php

namespace App\Services\Sorting;

/**
 * Class MergeSortV2
 * @package App\Services\Sorting
 *
 * Merge sort - sorts input array
 * O(n(log(n)))
 */
class MergeSortV2
{
    /**
     * @param $array
     * @param $start
     * @param $mid
     * @param $end
     *
     */
    private function merge(array &$array, $start, $mid, $end)
    {
        $left = array_slice($array, $start, $mid-$start+1);
        $right = array_slice($array, $mid+1, $end-$mid);
        $l = 0;
        $r = 0;
        $i = $start;

        while ($l < count($left) && $r < count($right)) {
            if ($left[$l] < $right[$r]) {
                $array[$i] =  $left[$l];
                $l++;
            }
            else {
                $array[$i] =  $right[$r];
                $r++;
            }
            $i++;
        }

        // if elements left in left or right part => replace needed elements in array by those
        for(; $r < count($right); $r++) {
            $array[$i] =  $right[$r];
            $i++;
        }
        for(; $l < count($left); $l++) {
            $array[$i] =  $left[$l];
            $i++;
        }

    }

    /**
     * @param array $array
     * @param int $start
     * @param int $end
     */
    public function sort(array &$array, $start = 0, $end = 0)
    {
        if ($start < $end) {
            $mid = intval(($start + $end) / 2);
            $this->sort($array, $start, $mid);
            $this->sort($array, $mid+1, $end);

            $this->merge($array, $start, $mid, $end);
        }

    }

}