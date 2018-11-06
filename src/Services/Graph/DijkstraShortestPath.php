<?php

namespace App\Services\Graph;

use App\DataStructures\WeightedGraph;

/**
 * Algorithm is used for finding shortest path in weighted graph
 *
 * Class DijkstraShortestPath
 * @package App\Services\Graph
 */
class DijkstraShortestPath extends GraphVisited
{

    /**
     * Array for saving path length
     *
     * path length from $start to $v is 5.5
     * $shortestPathLength[$v] = 5.5
     *
     * @var array
     */
    private $shortestPathLength;

    /**
     * Array for saving previous vertices in the shortest path
     *
     * p[current-vertex] = previous-vertex
     *
     * @var array
     */
    private $previousVertices;

    /**
     * DijkstraShortestPath constructor.
     */
    public function __construct()
    {
        $this->visited = [];
        $this->shortestPathLength = [];
        $this->previousVertices = [];
    }

    /**
     * Next vertex - it has minimum path length value among the not visited vertices
     *
     * @return int|null|string
     */
    private function getNextVertex()
    {
        $next = null;
        $min = PHP_INT_MAX;
        foreach($this->shortestPathLength as $vertex => $length) {
            if (!$this->visited[$vertex] && $length < $min) {
                $next = $vertex;
            }
        }

        return $next;
    }

    /**
     * O(m+n^n)
     *
     * @param WeightedGraph $g
     * @param $start
     * @param null $end
     */
    private function dijkstra(WeightedGraph $g, $start, $end = null)
    {
        foreach ($g->getVertices() as $v) {
            $this->shortestPathLength[$v] = PHP_INT_MAX;
            $this->visited[$v] = false;
        }

        $this->shortestPathLength[$start] = 0;
        $this->visited[$start] = true;
        $this->previousVertices[$start] = null;

        $current = $start;

        /**
         * O(m) - will check not more than m edges
         */
        while (count(array_filter($this->visited)) != count($g->getVertices())) {
            /**
             * 1. Update path length:
             *  - from $start to $vertex
             *  - for not visited adjacent vertices with vertex $current
             */
            foreach ($g->getConnectedVerticesList($current) as $node) {
                $vertex = $node->getVertex();
                if (!$this->visited[$vertex]) {
                    // Weight for '$current - $vertex' edge
                    $weight = $g->getWeight($vertex,  $current);
                    if ( $this->shortestPathLength[$vertex] > $this->shortestPathLength[$current] + $weight) {
                        $this->shortestPathLength[$vertex] = $this->shortestPathLength[$current] + $weight;
                        $this->previousVertices[$vertex] = $current;
                    }
                }
            }

            /**
             * O(n^n)
             * 2. Find next vertex:
             *  - it has minimum path length value among the not visited vertices
             */
            $current = $this->getNextVertex();
            $this->visited[$current] = true;

//            if ($current === $end) {
//                break;
//            }

        }
    }

    /**
     * @param WeightedGraph $g
     * @param $start
     * @param $end
     * @return array|null
     * @throws \Exception
     */
    public function shortestPath(WeightedGraph $g, $start, $end)
    {
        if (!$g->vertexExists($start))
        {
            throw new \Exception("Vertex $start does not exist");
        }

        if (!$g->vertexExists($end))
        {
            throw new \Exception("Vertex $end does not exist");
        }

        // main algorithm for preparing all data
        $this->dijkstra($g, $start, $end);

        if (!array_key_exists($end, $this->previousVertices)) {
            return null;
        }

        $path[] = $end;
        $prev = $this->previousVertices[$end];
        while(array_key_exists($prev, $this->previousVertices)) {
            $path[] = $prev;
            $prev = $this->previousVertices[$prev];
        }

        return [
            'path' => array_reverse($path),
            'length' => $this->shortestPathLength[$end]
        ];

    }

}