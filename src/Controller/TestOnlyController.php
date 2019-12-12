<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestOnlyController extends AbstractController
{
    /**
     * @Route("/test/only", name="test_only")
     */
    public function index()
    {
        return $this->render('test_only/index.html.twig', [
            'controller_name' => 'TestOnlyController',
        ]);
    }
}
