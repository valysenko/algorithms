<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Graph;
use App\Services\Graph\DFS;
use PHPUnit\Framework\TestCase;

class DFSTest extends TestCase
{

    /**
     * @var Graph
     */
    protected static $graph;

    /**
     * @var DFS
     */
    protected static $dfs;

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

        self::$dfs = new DFS();
    }

    public function testDFS()
    {
        $expectedDFSNumbers = [
            "s" => 1,
            "a" => 2,
            "d" => 3,
            "e" => 4,
            "c" => 5,
            "b" => 6
        ];

        self::$dfs->dfs(self::$graph, 's');
        $this->assertEquals(self::$dfs->getVisited(), $expectedDFSNumbers);
    }

}