<?php

namespace App\Services\Graph;

use App\DataStructures\Graph;
use App\DataStructures\Stack;

/**
 * Depth-first search
 *
 * Class DFS
 * @package App\Services\Graph
 */
class DFS
{
    /**
     * @var array
     */
    private $visited;

    /**
     * @return array
     */
    public function getVisited()
    {
        return $this->visited;
    }

    /**
     * O(n+m)
     * n - number of vertices
     * m - number of edges
     *
     * @param Graph $g
     * @param $vertex
     * @throws \Exception
     */
    public function dfs(Graph $g, $vertex)
    {
        if (!$g->vertexExists($vertex))
        {
            throw new \Exception("Vertex $vertex does not exist");
        }

        $dfsNumber = 1;
        $this->visited[$vertex] = $dfsNumber;

        $s = new Stack(20);
        $s->push($vertex);

        while (!$s->isEmpty()) {
            $v = $s->pop();
            if (!array_key_exists($v, $this->visited)) {
                $dfsNumber++;
                $this->visited[$v] = $dfsNumber;
            }

            $list = $g->getConnectedVerticesList($v);
            if ($list) {
                foreach ($list as $vertex) {
                    if (!array_key_exists($vertex, $this->visited)) {
                        $s->push($vertex);
                    }
                }
            }
        }

    }

}