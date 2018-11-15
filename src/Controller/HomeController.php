<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        $kazkas = $request->get('kazkas');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'studentas' => $kazkas,
        ]);
    }
}
