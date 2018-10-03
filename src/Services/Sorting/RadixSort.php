<?php

namespace App\Services\Sorting;

/**
 * Class CountingSort
 * @package App\Services\Sorting
 *
 * Stable Radix sort for all numbers
 * Algorithm uses modified Counting sort
 *
 * O(d*(n+k))
 * n - number of elements; k - the range of digits in radix ; d - number of digits in the biggest number.
 * maximum value of k in this case is 10
 * if k = O(n), d - const => T(n) = O(n)
 */
class RadixSort {

    /**
     * @param int $number
     * @param int $divider
     * @return int
     */
    private function getRadixDigit(int $number, int $divider)
    {
        return intdiv($number, $divider) % 10;
    }

    /**
     * @param array $array
     * @param int $divider
     * @return int
     */
    private function getMinValueOfRadix(array $array, int $divider)
    {
        $min = $this->getRadixDigit($array[0], $divider);

        for ($i = 1; $i < count($array); $i++ ) {
            $elem = $this->getRadixDigit($array[$i], $divider);
            if ($elem < $min) {
                $min = $elem;
            }
        }

        return $min;
    }

    /**
     * @param array $array
     * @param int $divider
     * @return int
     */
    private function getMaxValueOfRadix(array $array, int $divider)
    {
       $max = $this->getRadixDigit($array[0], $divider);

       for ($i = 1; $i < count($array); $i++ ) {
           $elem = $this->getRadixDigit($array[$i], $divider);
           if ($elem > $max) {
               $max = $elem;
           }
       }

       return $max;
    }

    /**
     * @param array $array
     * @return array
     */
    private function countingSort(array &$array, int $divider)
    {
        $result = [];
        $temp = [];

        $min = $this->getMinValueOfRadix($array, $divider);
        $max = $this->getMaxValueOfRadix($array, $divider);


        // $param is used for algorithm to handle cases when min != 0
        // If min < 0 Then: every index in temp array will be [array element + min*(-1)] in order to have first index 0
        // If min > 0 Then: every index in temp array will be [array element - min] in order to have first index 0
        // Temp array is used for storing positions of elements in the sorted array => first index should be 0
        if ($min != 0) {
            $param = $min * (-1);
        } else {
            $param = 0;
        }

        // 1. Calculate number of each element in current radix
        for ($i = $min; $i <= $max; $i++) {
            $temp[$i + $param] = 0;
        }

        for ($i = 0; $i < count($array); $i++) {
            $temp[$this->getRadixDigit($array[$i], $divider) + $param]  += 1;
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
            $radixElement = $this->getRadixDigit($element, $divider);
            $index = $temp[$radixElement + $param] - 1;

            $result[$index] = $element;

            // if there exists one more similar element
            // => it's position will be: position of current element - 1
            $temp[$radixElement + $param]--;

        }

        // 4. Need to copy result array to currently sortable because it wil be used in the next iteration
        for ($i = 0; $i <count($result); $i++) {
            $array[$i] = $result[$i];
        }

    }

    /**
     * @param array $array
     */
    public function sort(array &$array)
    {
        if(count($array) === 0) {
            return;
        }

        // 1. Find maximum value in order to know number of digits
        $max = abs($array[0]);
        for ($i = 1; $i <count($array); $i++) {
            $elem = abs($array[$i]);
            if ($elem > $max) {
                $max = $elem;
            }
        }

        // 2. Sort current array by every radix using modified counting sort
        for ($divider = 1; intdiv($max, $divider) > 0; $divider*=10) {
            $this->countingSort($array, $divider);
        }
    }

}