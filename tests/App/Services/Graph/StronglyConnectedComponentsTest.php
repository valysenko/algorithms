<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Graph;
use App\Services\Graph\DFSR;
use App\Services\Graph\StronglyConnectedComponents;
use App\Services\Graph\TransposeGraph;
use PHPUnit\Framework\TestCase;

class StronglyConnectedComponentsTest extends TestCase
{

    /**
     * @var Graph
     */
    protected static $graph;

    /**
     * @var StronglyConnectedComponents
     */
    protected static $scc;

    protected function setUp()
    {
        self::$graph = new Graph(Graph::DIRECTED_TYPE);
        self::$graph->insertEdge('a', 'b');
        self::$graph->insertEdge('b', 'c');
        self::$graph->insertEdge('c', 'a');
        self::$graph->insertEdge('b', 'd');
        self::$graph->insertEdge('d', 'f');
        self::$graph->insertEdge('f', 'd');
        self::$graph->insertEdge('e', 'b');
        self::$graph->insertEdge('e', 'g');
        self::$graph->insertEdge('g', 'e');


        self::$scc = new StronglyConnectedComponents(new TransposeGraph());
    }

    public function testFindStronglyConnectedComponents()
    {
        $scc = self::$scc->findStronglyConnectedComponents(self::$graph);
        $this->assertEquals(count($scc), 3);
        $this->assertEquals($scc[0], ['e', 'g']);
        $this->assertEquals($scc[1], ['a', 'c', 'b']);
        $this->assertEquals($scc[2], ['d', 'f']);
    }

}