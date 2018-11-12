<?php

namespace App\DataStructures\Nodes;
use App\DataStructures\Interfaces\Comparable;

/**
 * Class GraphNode
 *  - is used in the improved Dijkstra algorithm as a MinHeap node
 *
 * @package App\DataStructures\Nodes
 */
class TempNode implements Comparable
{
    /**
     * @var mixed
     */
    private $vertex;

    /**
     * @var double
     */
    private $weight;

    /**
     * GraphNode constructor.
     * @param mixed $vertex
     * @param float $weight
     */
    public function __construct($vertex, &$weight)
    {
        $this->vertex = $vertex;
        $this->weight = &$weight;
    }


    /**
     * @return mixed
     */
    public function getVertex()
    {
        return $this->vertex;
    }

    /**
     * @param mixed $vertex
     */
    public function setVertex($vertex)
    {
        $this->vertex = $vertex;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @param Comparable $object
     * @return int
     */
    public function compareTo(Comparable $object)
    {
        if ($this->getWeight() > $object->getWeight()) {
            return 1;
        } elseif ($this->getWeight() < $object->getWeight()) {
            return -1;
        }

        return 0;
    }

}