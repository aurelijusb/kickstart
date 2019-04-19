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
        $json = file_get_contents('https://nfq190418.realus.website/students.json');
        $data = json_decode($json, true);

        return $this->render('home/index.html.twig', [
            'someVariable' => 'Symfony first homework',
            'data' => $data,

        ]);
    }
}
