<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\WeightedGraph;
use App\Services\Graph\DijkstraShortestPathV2;
use PHPUnit\Framework\TestCase;

class DijkstraShortestPathV2TestTest extends TestCase
{

    /**
     * @var WeightedGraph
     */
    protected static $graph;

    /**
     * @var DijkstraShortestPathV2
     */
    protected static $dijkstraShortestPathV2;

    protected function setUp()
    {
        self::$graph = new WeightedGraph(WeightedGraph::UNDIRECTED_TYPE);
        self::$graph->insertWeightedEdge('s', 'a', 1);
        self::$graph->insertWeightedEdge('s', 'b', 2);
        self::$graph->insertWeightedEdge('a', 'c', 7);
        self::$graph->insertWeightedEdge('b', 'd', 3);
        self::$graph->insertWeightedEdge('a', 'd', 5);
        self::$graph->insertWeightedEdge('c', 'e', 1);
        self::$graph->insertWeightedEdge('d', 'e', 2);

        self::$dijkstraShortestPathV2 = new DijkstraShortestPathV2();
    }


    public function testShortestPath()
    {
        $result1 = self::$dijkstraShortestPathV2->shortestPath(self::$graph, 's', 'e');
        $result2 = self::$dijkstraShortestPathV2->shortestPath(self::$graph, 's', 'd');
        $result3 = self::$dijkstraShortestPathV2->shortestPath(self::$graph, 'a', 'e');
        $expectedPath1 = ['s', 'b', 'd', 'e'];
        $expectedPath2 = ['s', 'b', 'd'];
        $expectedPath3 = ['a', 'd', 'e'];

        $this->assertEquals($result1['path'], $expectedPath1);
        $this->assertEquals($result2['path'], $expectedPath2);
        $this->assertEquals($result3['path'], $expectedPath3);
        $this->assertEquals($result1['length'], 7);
        $this->assertEquals($result2['length'], 5);
        $this->assertEquals($result3['length'], 7);

    }

}