<?php

namespace App\Services\Sorting;

/**
 * Class QuickSort
 * @package App\Services\Sorting
 *
 * Quick sort - sorts input array
 * O(n(log(n)))
 */
class QuickSort
{

    /**
     * @param $array
     * @param int $start
     * @param int $end
     * @return mixed
     */
    private function randomizedPartition(&$array, int $start, int $end)
    {
        $i = rand($start, $end);
        $t = $array[$i];
        $array[$i] = $array[$end];
        $array[$end] = $t;

        return $this->partition($array, $start, $end);
    }

    /**
     * @param $array
     * @param $start
     * @param $end
     * @return mixed
     */
    private function partition(&$array, int $start, int $end)
    {
        $index = $array[$end];
        $i = $start - 1;
        for ($j = $start; $j < $end; $j++) {
            if ($array[$j] <= $index ) {
                $i++;
                $t = $array[$j];
                $array[$j] = $array[$i];
                $array[$i] = $t;
            }
        }

        $t = $array[$end];
        $array[$end] = $array[$i+1];
        $array[$i+1] = $t;

        return $i + 1;
    }


    /**
     * @param array $array
     * @param int $start
     * @param int $end
     * @return array
     */
    public function sort(array &$array, int $start, int $end): array
    {
        if ($start < $end) {
            $q = $this->randomizedPartition($array, $start, $end);
            $this->sort($array, $start, $q-1);
            $this->sort($array, $q+1, $end);
        }
        return $array;
    }

}