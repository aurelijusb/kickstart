<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DataController extends AbstractController
{
    /**
     * @Route("/data", name="data")
     */
    public function index()
    {

        return $this->render('data/index.html.twig', [
            'controller_name' => 'DataController',
        ]);
    }
}
