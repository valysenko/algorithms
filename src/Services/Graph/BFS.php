<?php

namespace App\Services\Graph;

use App\DataStructures\Graph;
use App\DataStructures\LinkedQueue;

/**
 * Breadth-first search
 *
 * Class BFS
 */
class BFS
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
     * n - number of vertex
     * m - number of edges
     *
     * @param Graph $g
     * @param $startVertex
     *
     * @return array
     * @throws \Exception
     *
     */
    public function bfs(Graph $g, $startVertex)
    {

        if (!$g->vertexExists($startVertex))
        {
            throw new \Exception("Vertex $startVertex does not exist");
        }
        
        $bfsNumber = 1;
        $this->visited[$startVertex] = $bfsNumber;

        $q = new LinkedQueue();
        $q->enqueue($startVertex);

        while (!$q->isEmpty())
        {
            $v = $q->dequeue()->getItem();
            $list = $g->getConnectedVerticesList($v);
            if ($list) {
                foreach ($list as $vertex) {
                    if (!array_key_exists($vertex, $this->visited)) {
                        $bfsNumber++;
                        $this->visited[$vertex] = $bfsNumber;
                        $q->enqueue($vertex);
                    }
                }
            }

        }

    }

}