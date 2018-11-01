<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Graph;
use App\Services\Graph\DFSR;
use App\Services\Graph\TopologicalSort;
use PHPUnit\Framework\TestCase;

class TopologicalSortTest extends TestCase
{

    /**
     * @var Graph
     */
    protected static $graph;

    /**
     * @var TopologicalSort
     */
    protected static $topologicalSort;

    protected function setUp()
    {
        // Directed graph
        self::$graph = new Graph(Graph::DIRECTED_TYPE);
        self::$graph->insertEdge('a', 'b');
        self::$graph->insertEdge('a', 'c');
        self::$graph->insertEdge('a', 'd');
        self::$graph->insertEdge('d', 'e');
        self::$graph->insertEdge('b', 'f');
        self::$graph->insertEdge('c', 'f');

        self::$topologicalSort = new TopologicalSort();
    }

    public function testSort()
    {
        $expectedTopologicalNumbers = [
            "f" => 6,
            "b" => 5,
            "c" => 4,
            "e" => 3,
            "d" => 2,
            "a" => 1
        ];

        $result = self::$topologicalSort->sort(self::$graph);
        $this->assertEquals($result, $expectedTopologicalNumbers);
    }

}