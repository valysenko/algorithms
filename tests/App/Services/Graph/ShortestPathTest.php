<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Graph;
use App\Services\Graph\ShortestPath;
use PHPUnit\Framework\TestCase;

class ShortestPathTest extends TestCase
{

    /**
     * @var Graph
     */
    protected static $graph;

    /**
     * @var ShortestPath
     */
    protected static $shortestPath;

    protected function setUp()
    {
        // Directed graph
        self::$graph = new Graph(Graph::DIRECTED_TYPE);
        self::$graph->insertEdge('a', 'b');
        self::$graph->insertEdge('a', 'c');
        self::$graph->insertEdge('b', 'd');
        self::$graph->insertEdge('d', 'e');
        self::$graph->insertEdge('e', 'f');
        self::$graph->insertEdge('e', 'h');
        self::$graph->insertEdge('f', 'h');
        self::$graph->insertEdge('h', 'j');
        self::$graph->insertEdge('j', 'm');
        self::$graph->insertEdge('h', 'k');
        self::$graph->insertEdge('k', 'l');

        self::$shortestPath = new ShortestPath();
    }

    public function testPreviousVertices()
    {
        // previous vertices in the shortest path
        $previousVertices = self::$shortestPath->previousVertices(self::$graph, 'a');

        $this->assertEquals($previousVertices['h'], 'e');
        $this->assertEquals($previousVertices['c'], 'a');
        $this->assertEquals($previousVertices['l'], 'k');
        $this->assertEquals($previousVertices['j'], 'h');

    }

    public function testShortestPath()
    {
        $path1 = self::$shortestPath->shortestPath(self::$graph, 'a', 'l');
        $path2 = self::$shortestPath->shortestPath(self::$graph, 'b', 'h');
        $path3 = self::$shortestPath->shortestPath(self::$graph, 'd', 'm');
        $expectedPath1 = ['a', 'b', 'd', 'e', 'h', 'k', 'l'];
        $expectedPath2 = ['b', 'd', 'e', 'h'];
        $expectedPath3 = ['d', 'e', 'h', 'j', 'm'];

        $this->assertEquals($path1, $expectedPath1);
        $this->assertEquals($path2, $expectedPath2);
        $this->assertEquals($path3, $expectedPath3);

    }

}