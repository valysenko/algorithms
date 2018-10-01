<?php

namespace App\Services\Sorting;

/**
 * Class CountingSort
 * @package App\Services\Sorting
 *
 * Stable Counting sort for numbers between 0 and k-1
 *
 * O(n+k);  n - number of elements; k - the range of input.
 * => Efficient when k is not significantly greater than n
 */
class CountingSortV1
{
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

        // 1. Calculate number of each element in array
        // $temp[element] = quantity
        for ($i = $min; $i <= $max; $i++) {
            $temp[$i] = 0;
        }

        for ($i = 0; $i < count($array); $i++) {
            $temp[$array[$i]]  += 1;
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
            $index = $temp[$element] - 1;
            $result[$index] = $element;

            // if there exists one more similar element
            // => it's position will be: position of current element - 1
            $temp[$array[$i]] = $temp[$array[$i]]-1;
        }

        return $result;
    }

}