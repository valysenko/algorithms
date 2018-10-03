<?php

namespace App\Services\Sorting;

/**
 * Class CountingSort
 * @package App\Services\Sorting
 *
 * Stable Counting sort for all numbers
 *
 * O(n+k);  n - number of elements; k - the range of input.
 * => Efficient when k is not significantly greater than n
 */
class CountingSortV2 {
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array, $min = null , $max = null): array
    {
        $result = [];
        $temp = [];

        if (!$min) {
            $min = min($array);
        }
        if (!$max) {
            $max = max($array);
        }

        // $param is used for algorithm to handle cases when min != 0
        // If min < 0 Then: every index in temp array will be [array element + min*(-1)] in order to have first index 0
        // If min > 0 Then: every index in temp array will be [array element - min] in order to have first index 0
        // Temp array is used for storing positions of elements in the sorted array => first index should be 0
        if ($min != 0) {
            $param = $min * (-1);
        } else {
            $param = 0;
        }

        // 1. Calculate number of each element in array
        // $temp[element] = quantity
        for ($i = $min; $i <= $max; $i++) {
            $temp[$i + $param] = 0;
        }

        for ($i = 0; $i < count($array); $i++) {
            $temp[$array[$i] + $param]  += 1;
            $result[$i] = 0;
        }


        // 2. To each element of array add previous element
        // temp[element] = quantity
        // => Each value = number of elements which are NOT greater than current element (key)
        // => Each value = position of element in sorted array + 1
        for ($i = 1; $i < count($temp); $i++) {
            $temp[$i] += $temp[$i-1];
        }

        // 3. Place elements on its positions in the results array
        for ($i = count($array)-1; $i>=0; $i--) {
            $element = $array[$i];
            $index = $temp[$element + $param] - 1;

            $result[$index] = $element;

            // if there exists one more similar element
            // => it's position will be: position of current element - 1
            $temp[$element + $param]--;

        }

        return $result;
    }

}