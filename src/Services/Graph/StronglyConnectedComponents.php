<?php

namespace App\Services\Graph;


use App\DataStructures\Graph;

/**
 * Find strongly connected components in the Directed graph
 * - using modified DFS algorithm
 *
 * Class StronglyConnectedComponent
 * @package App\Services\Graph
 */
class StronglyConnectedComponents extends GraphVisited
{

    /**
     * @var TransposeGraph
     */
    private $transposeGraph;

    /**
     * @var array
     */
    private $connectedComponents;

    /**
     * End time processing for vertices
     *
     * Example:
     * first processed vertex has 1,
     * second process vertex has 2
     *
     * @var array
     */
    private $endTimeProcessing;

    /**
     * @var int
     */
    private $t;

    /**
     * StrongConnectedComponent constructor.
     * @param TransposeGraph $transposeGraph
     */
    public function __construct(TransposeGraph $transposeGraph)
    {
        $this->transposeGraph = $transposeGraph;
        $this->t = 0;
        $this->endTimeProcessing = [];
        $this->connectedComponents = [];
    }

    /**
     * O(n+m)
     *
     * @param Graph $g
     * @param $vertex
     * @param int $i
     */
    private function dfsr(Graph $g, $vertex, $i = 0)
    {
        $this->visited[$vertex] = true;

        $list = $g->getConnectedVerticesList($vertex);
        if ($list) {
            // save vertex in the array of connected components
            if (!array_key_exists($i, $this->connectedComponents) || !in_array($vertex, $this->connectedComponents[$i])) {
                $this->connectedComponents[$i][] = $vertex;
            }

            foreach ($list as $v) {
                if (!array_key_exists($v, $this->visited)) {

                    // save vertex in the array of connected components
                    if (!in_array($v, $this->connectedComponents[$i])) {
                        $this->connectedComponents[$i][] = $v;
                    }

                    $this->dfsr($g, $v, $i);
                }
            }
        }

        // current vertex does not have adjacent vertices - save it't processing time
        if (!array_key_exists($vertex, $this->endTimeProcessing)) {
            $this->t++;
            $this->endTimeProcessing[$vertex] = $this->t;
        }

    }

    /**
     * O(n+m)
     *
     * @param Graph $g
     */
    public function findEndTimeProcessing(Graph $g)
    {
       foreach ($g->getVertices() as $vertex) {
           $this->dfsr($g, $vertex);
       }
    }

    /**
     * O(n+m)
     *
     * @param Graph $g
     */
    public function prepareConnectedComponents(Graph $g)
    {
        arsort($this->endTimeProcessing);
        $n = 0;
        foreach ($this->endTimeProcessing as $vertex => $value) {
            if (!array_key_exists($vertex, $this->visited)) {
                $this->dfsr($g, $vertex, $n);
                $n++;
            }
        }
    }

    /**
     * O(n+m)
     *
     * @param Graph $g
     * @return array
     */
    public function findStronglyConnectedComponents(Graph $g)
    {
        // 1. Find end time processing for every vertex
        $this->findEndTimeProcessing($g);

        // 2. Transpose the graph
        $tg = $this->transposeGraph->getTransposedGraph($g);
        $this->connectedComponents = [];
        $this->visited = [];

        // 3. Find connected components: 1 loop iteration is 1 connected component
        $this->prepareConnectedComponents($tg);

        return $this->connectedComponents;
    }

}