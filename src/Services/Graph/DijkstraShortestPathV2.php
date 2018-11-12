<?php

namespace App\Services\Graph;

use App\DataStructures\ModifiedMinHeap;
use App\DataStructures\Nodes\TempNode;
use App\DataStructures\WeightedGraph;

/**
 * Improved algorithm is used for finding shortest path in weighted graph
 * - with the use of min heap (min priority queue)
 *
 * Class DijkstraShortestPathV2
 * @package App\Services\Graph
 */
class DijkstraShortestPathV2 extends GraphVisited
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
     * @var ModifiedMinHeap
     */
    private $queue;

    /**
     * DijkstraShortestPath constructor.
     */
    public function __construct()
    {
        $this->visited = [];
        $this->shortestPathLength = [];
        $this->previousVertices = [];
        $this->queue = new ModifiedMinHeap();
    }

    /**
     * O(m*log(n))
     *
     * @param WeightedGraph $g
     * @param $start
     * @param null $end
     */
    private function dijkstra(WeightedGraph $g, $start, $end = null)
    {
        /**
         * 1. Prepare data
         */

        $temp = [];
        foreach ($g->getVertices() as $v) {
            $this->shortestPathLength[$v] = PHP_INT_MAX;
            $this->visited[$v] = false;

            // TempNode contains link to the vertex weight
            $temp[] = new TempNode($v, $this->shortestPathLength[$v]);
        }

        $this->shortestPathLength[$start] = 0;
        $this->visited[$start] = true;
        $this->previousVertices[$start] = null;

        // Build min heap (min priority queue) O(n*log(n))
        $this->queue->build($temp);

        /**
         * O(m) - will check not more than m edges
         */
        while ($this->queue->size() > 0) {

            // O(log(n))
            $current = $this->queue->extractMin()->getVertex();

            /**
             * 1. Update path length:
             *  - from $start to $vertex
             *  - for not visited adjacent vertices with vertex $current
             *
             * 2. Update position for next element in min heap
             *  - after update this element will be first in the min heap and next in the loop
             */
            foreach ($g->getConnectedVerticesList($current) as $node) {
                $vertex = $node->getVertex();
                if (!$this->visited[$vertex]) {

                    // Weight for '$current - $vertex' edge
                    $weight = $g->getWeight($vertex,  $current);

                    if ( $this->shortestPathLength[$vertex] > $this->shortestPathLength[$current] + $weight) {
                        $this->shortestPathLength[$vertex] = $this->shortestPathLength[$current] + $weight;
                        $this->previousVertices[$vertex] = $current;

                        // O(log(n))
                        // update element position
                        $this->queue->fixPosition($vertex);
                    }
                }
            }

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