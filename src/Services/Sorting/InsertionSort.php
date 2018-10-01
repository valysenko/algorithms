<?php

namespace App\Services\Sorting;

/**
 * Class InsertionSort
 * @package App\Services\Sorting
 *
 * O(n^2))
 */
class InsertionSort
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array): array
    {
        for ($i = 1; $i < count($array); $i++) {
            $j = $i-1;
            $key = $array[$i];
            while($j >= 0 && $array[$j] > $key) {
                $array[$j+1] = $array[$j];
                $j--;
            }
            $array[$j+1] = $key;
        }

        return $array;
    }

}