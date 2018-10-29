<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Graph;
use App\Services\Graph\BFS;
use PHPUnit\Framework\TestCase;

class BFSTest extends TestCase
{

    /**
     * @var Graph
     */
    protected static $graph;

    /**
     * @var BFS
     */
    protected static $bfs;

    protected function setUp()
    {
        // Directed graph
        self::$graph = new Graph();
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

        self::$bfs = new BFS();
    }


    public function testShortestPathsLength()
    {

        // shortest path length from 'a' to all other vertices
        $shortestPaths = self::$bfs->shortestPathsLength(self::$graph, 'a');

        $this->assertEquals($shortestPaths['h'], 4);
        $this->assertEquals($shortestPaths['l'], 6);

        // shortest path from 'e' to all other vertices
        $shortestPaths = self::$bfs->shortestPathsLength(self::$graph, 'e');

        $this->assertEquals($shortestPaths['h'], 1);
        $this->assertEquals($shortestPaths['m'], 3);

    }

    public function testPreviousVerticesLength()
    {
        // previous vertices in the shortest path
        $previousVertices = self::$bfs->previousVertices(self::$graph, 'a');

        $this->assertEquals($previousVertices['h'], 'e');
        $this->assertEquals($previousVertices['c'], 'a');
        $this->assertEquals($previousVertices['l'], 'k');
        $this->assertEquals($previousVertices['j'], 'h');

    }

    public function testShortestPath()
    {
        $path1 = self::$bfs->shortestPath(self::$graph, 'a', 'l');
        $path2 = self::$bfs->shortestPath(self::$graph, 'b', 'h');
        $path3 = self::$bfs->shortestPath(self::$graph, 'd', 'm');
        $expectedPath1 = ['a', 'b', 'd', 'e', 'h', 'k', 'l'];
        $expectedPath2 = ['b', 'd', 'e', 'h'];
        $expectedPath3 = ['d', 'e', 'h', 'j', 'm'];

        $this->assertEquals($path1, $expectedPath1);
        $this->assertEquals($path2, $expectedPath2);
        $this->assertEquals($path3, $expectedPath3);

    }

    public function testVertexDoesNotExistException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Vertex z does not exist');
        self::$bfs->shortestPathsLength(self::$graph, 'z');
    }

}