<?php

namespace App\DataStructures;

/**
 * Class Graph
 * @package App\DataStructures
 */
class Graph extends BaseGraph
{

    /**
     * @param $vertex1
     * @param $vertex2
     */
    public function insertEdge($vertex1, $vertex2)
    {
        $this->adjacencyList[$vertex1][] = $vertex2;
        if ($this->type === self::UNDIRECTED_TYPE) {
            $this->adjacencyList[$vertex2][] = $vertex1;
        }

        if (!in_array($vertex1, $this->vertices))
        {
            $this->vertices[] = $vertex1;
        }

        if (!in_array($vertex2, $this->vertices))
        {
            $this->vertices[] = $vertex2;
        }

    }

}