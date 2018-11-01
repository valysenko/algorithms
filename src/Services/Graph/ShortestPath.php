<?php

namespace App\Services\Graph;

use App\DataStructures\Graph;
use App\DataStructures\LinkedQueue;

/**
 * Find shortest path from u to v
 *  - using BFS algorithm
 *
 * Class ShortestPath
 * @package App\Services\Graph
 */
class ShortestPath
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
     * Output: An array of previous vertices [in the shortest path] for all vertices
     *
     * @param Graph $g
     * @param $startVertex
     * @param $endVertex
     *
     * @return array
     * @throws \Exception
     */
    public function previousVertices(Graph $g, $startVertex, $endVertex = null)
    {

        if (!$g->vertexExists($startVertex))
        {
            throw new \Exception("Vertex $startVertex does not exist");
        }

        // p[$vertex] = previous vertex
        $p[$startVertex] = null;

        // d[$vertex] = number of edges from $startVertex to $vertex
//        $d[$startVertex] = 0;

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

                        // p[current-vertex] = previous-vertex
                        $p[$vertex] = $v;

                        // d[current-vertex] = d[previous-vertex] +1
                        //$d[$vertex] = $d[$v] + 1;

                        if ($endVertex && $vertex === $endVertex) {
                            return $p;
                        }
                    }
                }
            }

        }

        return $p;
    }

    /**
     * Returns shortest path from $start to $end
     * Output: array which includes vertices from $start to $end
     *
     * @param Graph $g
     * @param $start
     * @param $end
     *
     * @return array|null
     * @throws \Exception
     */
    public function shortestPath(Graph $g, $start, $end)
    {
        if (!$g->vertexExists($start))
        {
            throw new \Exception("Vertex $start does not exist");
        }

        if (!$g->vertexExists($end))
        {
            throw new \Exception("Vertex $end does not exist");
        }

        $this->visited = [];
        $path[] = $end;

        // find previous vertices for all vertices in the shortest path from $start to $end
        $prevVertices = $this->previousVertices($g, $start, $end);

        if (!array_key_exists($end, $prevVertices)) {
            return null;
        }

        $prev = $prevVertices[$end];
        while(array_key_exists($prev, $prevVertices)) {
            $path[] = $prev;
            $prev = $prevVertices[$prev];
        }

        return array_reverse($path);
    }
}