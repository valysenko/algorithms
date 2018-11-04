<?php

namespace App\Services\Graph;


use App\DataStructures\Graph;

/**
 * Class TransposeGraph
 * @package App\Services\Graph
 */
class TransposeGraph
{
    /**
     * O(m)
     * m - number of edges
     *
     * @param Graph $g
     * @return Graph
     */
    public function getTransposedGraph(Graph $g)
    {
        $tg = new Graph(Graph::DIRECTED_TYPE);

        foreach ($g->getAdjacencyList() as $vertex => $vertices) {
            foreach ($vertices as $v) {
                $tg->insertEdge($v, $vertex);
            }
        }

        return $tg;
    }

}