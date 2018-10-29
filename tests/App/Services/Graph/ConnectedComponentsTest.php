<?php

namespace App\Tests\Services\Sorting;

use App\DataStructures\Graph;
use App\Services\Graph\ConnectedComponents;
use PHPUnit\Framework\TestCase;

class ConnectedComponentsTest extends TestCase
{

    /**
     * @var Graph
     */
    protected static $graph;

    protected function setUp()
    {
        // Oriented graph
        self::$graph = new Graph();
        self::$graph->insertEdge('a', 'b');
        self::$graph->insertEdge('a', 'c');
        self::$graph->insertEdge('b', 'a');
        self::$graph->insertEdge('c', 'a');

        self::$graph->insertEdge('d', 'e');
        self::$graph->insertEdge('e', 'd');

        self::$graph->insertEdge('f', 'g');
        self::$graph->insertEdge('g', 'h');
        self::$graph->insertEdge('g', 'i');
        self::$graph->insertEdge('g', 'f');
        self::$graph->insertEdge('h', 'g');
        self::$graph->insertEdge('i', 'g');

        self::$graph->insertEdge('p', 'q');
        self::$graph->insertEdge('q', 'p');
    }

    public function testFindConnectedComponents()
    {
        $cc = new ConnectedComponents();
        $components = $cc->findConnectedComponents(self::$graph);
        $this->assertEquals(count($components), 4);
        $this->assertEquals($components[0], ['a', 'b', 'c']);
        $this->assertEquals($components[1], ['d', 'e']);
        $this->assertEquals($components[2], ['f', 'g', 'h', 'i']);
        $this->assertEquals($components[3], ['p', 'q']);
    }

}