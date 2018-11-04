<?php

namespace App\Services\Graph;


use App\DataStructures\Graph;
use App\DataStructures\Stack;

/**
 * Depth-first search recursive
 *
 * Class DFSR
 * @package App\Services\Graph
 */
class DFSR extends GraphVisited
{

    /**
     * O(n+m)
     * n - number of vertices
     * m - number of edges
     *
     * @param Graph $g
     * @param $vertex
     * @param int $dfsNumber
     * @return int
     * @throws \Exception
     */
    public function dfs(Graph $g, $vertex, $dfsNumber = 1)
    {
        if (!$g->vertexExists($vertex))
        {
            throw new \Exception("Vertex $vertex does not exist");
        }

        $this->visited[$vertex] = $dfsNumber;

        $list = $g->getConnectedVerticesList($vertex);
        if ($list) {
            foreach ($list as $v) {
                if (!array_key_exists($v, $this->visited)) {
                    $dfsNumber = $this->dfs($g, $v, $dfsNumber+1);
                }
            }
        }

        return $dfsNumber;
    }



}