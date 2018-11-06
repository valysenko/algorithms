<?php

namespace App\DataStructures\Nodes;

/**
 * Class GraphNode
 * @package App\DataStructures\Nodes
 */
class GraphNode
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

}