<?php

namespace App\Services\Graph;

use App\DataStructures\Graph;
use App\DataStructures\LinkedQueue;

/**
 * Breadth-first search
 *
 * Class contains different modifications of the BFS algorithm
 * - shortest path length
 * - previous vertices
 * - shortest path
 *
 * Class BFS
 */
class BFS
{
    /**
     * O(n+m)
     * n - number of vertex
     * m - number of edges
     *
     * Output: An array of shortest paths length from $startVertex to all vertices of the graph
     * Length = number of edges between $startVertex and current
     *
     * @param Graph $g
     * @param $startVertex
     *
     * @return array
     * @throws \Exception
     *
     */
    public function shortestPathsLength(Graph $g, $startVertex)
    {

        if (!$g->vertexExists($startVertex))
        {
            throw new \Exception("Vertex $startVertex does not exist");
        }

        // d[$vertex] = number of edges from $startVertex to $vertex
        $d[$startVertex] = 0;

        $exploredVertex = [];
        $bfsNumber = 1;
        $exploredVertex[$startVertex] = $bfsNumber;

        $q = new LinkedQueue();
        $q->enqueue($startVertex);

        while (!$q->isEmpty())
        {
            $v = $q->dequeue()->getItem();
            $list = $g->getConnectedVerticesList($v);
            if ($list) {
                foreach ($list as $vertex) {
                    if (!array_key_exists($vertex, $exploredVertex)) {
                        $bfsNumber++;
                        $exploredVertex[$vertex] = $bfsNumber;
                        $q->enqueue($vertex);

                        // d[current-vertex] = d[previous-vertex] +1
                        $d[$vertex] = $d[$v] + 1;
                    }
                }
            }

        }

        return $d;
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

        $exploredVertex = [];
        $bfsNumber = 1;
        $exploredVertex[$startVertex] = $bfsNumber;

        $q = new LinkedQueue();
        $q->enqueue($startVertex);

        while (!$q->isEmpty())
        {
            $v = $q->dequeue()->getItem();
            $list = $g->getConnectedVerticesList($v);
            if ($list) {
                foreach ($list as $vertex) {
                    if (!array_key_exists($vertex, $exploredVertex)) {
                        $bfsNumber++;
                        $exploredVertex[$vertex] = $bfsNumber;
                        $q->enqueue($vertex);

                        // p[current-vertex] = previous-vertex
                        $p[$vertex] = $v;

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

        $path[] = $end;
        $vertices = $this->previousVertices($g, $start, $end);

        if (!array_key_exists($end, $vertices)) {
            return null;
        }

        $prev = $vertices[$end];
        while(array_key_exists($prev, $vertices)) {
            $path[] = $prev;
            $prev = $vertices[$prev];
        }

        return array_reverse($path);
    }

}