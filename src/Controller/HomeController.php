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

        return $this->render('home/akademija.html.twig', [
            'studentas' => $kazkas,
            'kintamasis' => ['labai' => [
                'sudėtingą',
                'mažą',
                'daiktą'
            ]]
        ]);
    }
}
