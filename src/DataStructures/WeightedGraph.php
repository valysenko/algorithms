<?php

namespace App\DataStructures;


use App\DataStructures\Nodes\GraphNode;

/**
 * Class WeightedGraph
 * @package App\DataStructures
 */
class WeightedGraph extends BaseGraph
{
    /**
     * @param $vertex1
     * @param $vertex2
     */
    public function insertWeightedEdge($vertex1, $vertex2, $weight)
    {
        $graphNode = new GraphNode();
        $graphNode->setVertex($vertex2);
        $graphNode->setWeight($weight);

        $this->adjacencyList[$vertex1][] = $graphNode;

        if ($this->type === self::UNDIRECTED_TYPE) {
            $graphNode = new GraphNode();
            $graphNode->setVertex($vertex1);
            $graphNode->setWeight($weight);
            $this->adjacencyList[$vertex2][] = $graphNode;
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

    public function getWeight($vertex1, $vertex2)
    {
        foreach ($this->adjacencyList[$vertex1] as $item) {
            if($item->getVertex() == $vertex2) {
                return $item->getWeight();
            }
        }
    }

}