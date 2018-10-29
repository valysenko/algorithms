<?php

namespace App\Services\Graph;

use App\DataStructures\Graph;
use App\DataStructures\LinkedQueue;

/**
 * Find connected components in the Undirected graph
 * - using BFS algorithm
 *
 *
 * Class BFS
 */
class ConnectedComponents
{

    /**
     * O(n+m)
     * n - number of vertices
     * m - number of edges
     *
     * @param Graph $g
     * @param $from
     * @param $exploredVertices
     * @param $connectedComponents
     * @param $n
     * @return bool
     */
    private function bfs(Graph $g, $from, array &$exploredVertices, array &$connectedComponents, int $n)
    {
        $bfsNumber = 1;
        $exploredVertices[$from] = $bfsNumber;
        $connectedComponents[$n][] = $from;

        $q = new LinkedQueue();
        $q->enqueue($from);

        while (!$q->isEmpty())
        {
            $v = $q->dequeue()->getItem();
            $list = $g->getConnectedVerticesList($v);
            if ($list) {
                foreach ($list as $vertex) {
                    if (!array_key_exists($vertex, $exploredVertices)) {
                        $bfsNumber++;
                        $exploredVertices[$vertex] = $bfsNumber;
                        $connectedComponents[$n][] = $vertex;
                        $q->enqueue($vertex);
                    }
                }
            }

        }

        return false;
    }

    /**
     * O(n1 + n2 + ... + m1 + m2 + ...) = O(n+m)
     *
     * Find connected components in the Undirected graph
     *
     * Output: Array of connected components
     * Each connected component is an array of vertices
     *
     * @param Graph $g
     * @return array
     */
    public function findConnectedComponents(Graph $g)
    {
        $connectedComponents = [];
        $exploredVertices = [];
        $n = 0;
        foreach ($g->getVertices() as $v) {
            if (!array_key_exists($v, $exploredVertices)) {
                $this->bfs($g, $v, $exploredVertices, $connectedComponents, $n);
                $n++;
            }
        }

        return $connectedComponents;
    }

}