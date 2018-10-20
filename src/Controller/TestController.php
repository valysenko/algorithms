<?php

namespace App\Controller;

use App\DataStructures\SeparateChainingHashTable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
