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
        self::$graph = new Graph(Graph::UNDIRECTED_TYPE);
        self::$graph->insertEdge('s', 'b');
        self::$graph->insertEdge('s', 'a');
        self::$graph->insertEdge('b', 'd');
        self::$graph->insertEdge('d', 'e');
        self::$graph->insertEdge('a', 'c');
        self::$graph->insertEdge('c', 'e');
        self::$graph->insertEdge('a', 'd');

        self::$bfs = new BFS();
    }


    public function testBFS()
    {
        $expectedBFSNumbers = [
            "s" => 1,
            "b" => 2,
            "a" => 3,
            "d" => 4,
            "c" => 5,
            "e" => 6
        ];

        self::$bfs->bfs(self::$graph, 's');
        $this->assertEquals(self::$bfs->getVisited(), $expectedBFSNumbers);
    }

    public function testVertexDoesNotExistException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Vertex z does not exist');
        self::$bfs->bfs(self::$graph, 'z');
    }

}