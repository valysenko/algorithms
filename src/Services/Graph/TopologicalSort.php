<?php

namespace App\Services\Graph;

use App\DataStructures\Graph;

/**
 * Topological Sort for Directed graph
 * - using DFS recoursive algorithm
 *
 * => Specify linear order of vertices so that:
 * - any edge leads from the vertex with a smaller number to the vertex with a larger number.
 * - U -> V (number for U < number for V)
 *
 *
 * Class TopologicalSort
 * @package App\Services\Graph
 */
class TopologicalSort extends GraphVisited
{

    /**
     * @var int
     */
    private $label;

    /**
     * @var array
     */
    private $topologicalNumbers;

    /**
     * TopologicalSort constructor.
     */
    public function __construct()
    {
        $this->topologicalNumbers = [];
        $this->visited = [];
        $this->label = 0;
    }

    /**
     * O(n+m)
     * n - number of vertices
     * m - number of edges
     *
     * @param Graph $g
     * @param $vertex
     */
    private function dfsr(Graph $g, $vertex)
    {
        $this->visited[$vertex] = true;

        $list = $g->getConnectedVerticesList($vertex);
        if ($list) {
            foreach ($list as $v) {
                if (!array_key_exists($v, $this->visited)) {
                    $this->dfsr($g, $v);
                }
            }
        }

        $this->topologicalNumbers[$vertex] = $this->label;
        $this->label--;
    }

    /**
     *
     * Output: array with topological numbers for vertices
     *
     * @param Graph $g
     * @return array
     */
    public function sort(Graph $g)
    {
        $this->label = count($g->getVertices());
        foreach ($g->getVertices() as $v) {
            if (!array_key_exists($v, $this->visited)) {
               $this->dfsr($g, $v);
            }
        }

        return $this->topologicalNumbers;
    }

}