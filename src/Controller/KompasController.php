<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class KompasController extends Controller
{
    /**
     * @Route("/kompas", name="kompas")
     */
    public function index()
    {
        return $this->render('kompas/index.html.twig', [
            'controller_name' => 'KompasController',
        ]);
    }
}
