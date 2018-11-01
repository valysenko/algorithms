<?php

namespace App\Controller;

use App\DataStructures\Graph;
use App\Services\Graph\DFS;
use App\Services\Graph\DFSR;
use App\Services\Graph\TopologicalSort;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Tests\Compiler\G;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        $g = new Graph(Graph::UNDIRECTED_TYPE);
        $g->insertEdge('s', 'b');
        $g->insertEdge('s', 'a');
        $g->insertEdge('b', 'd');
        $g->insertEdge('a', 'c');
        $g->insertEdge('d', 'e');
        $g->insertEdge('c', 'e');
        $g->insertEdge('d', 'a');
dump($g->getAdjacencyList());
//        $d = new DFSR();
//        $d->dfs($g,'s');
//        dump($d->getExploredVertices());

        $dd = new DFS();
        $dd->dfs($g,'s');
        dump($dd->getExploredVertices());
        die;

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
