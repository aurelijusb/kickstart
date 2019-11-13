<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $json = file_get_contents('https://hw1.nfq2019.online/students.json');
        $obj = json_decode($json, true);

        return $this->render('home/index.html.twig', [
            'students' => $obj,
        ]);
    }
}
