<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $jsonPath = __DIR__.'/../../public/students.json';
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);

        return $this->render('home/index.html.twig', [
            'someVariable' => 'Symfony first homework',
            'data' => $data,

        ]);
    }
}
