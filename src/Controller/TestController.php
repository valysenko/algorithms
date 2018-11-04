<?php

namespace App\Controller;

use App\DataStructures\Graph;
use App\Services\Graph\DFS;
use App\Services\Graph\DFSR;
use App\Services\Graph\StronglyConnectedComponents;
use App\Services\Graph\TopologicalSort;
use App\Services\Graph\TransposeGraph;
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
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
