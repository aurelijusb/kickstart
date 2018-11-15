<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VakarasController extends AbstractController
{
    /**
     * @Route("/evening", name="vakaras")
     */
    public function index()
    {
        return $this->render('vakaras/index.html.twig', [
            'controller_name' => 'VakarasController',
        ]);
    }
}
