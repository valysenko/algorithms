<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Graph;
use App\Services\Graph\DFSR;
use PHPUnit\Framework\TestCase;

class DFSRTest extends TestCase
{

    /**
     * @var Graph
     */
    protected static $graph;

    /**
     * @var DFSR
     */
    protected static $dfsr;

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

        self::$dfsr = new DFSR();
    }

    public function testDFS()
    {
        $expectedDFSNumbers = [
            "s" => 1,
            "b" => 2,
            "d" => 3,
            "e" => 4,
            "c" => 5,
            "a" => 6
        ];

        self::$dfsr->dfs(self::$graph, 's');
        $this->assertEquals(self::$dfsr->getVisited(), $expectedDFSNumbers);
    }

}