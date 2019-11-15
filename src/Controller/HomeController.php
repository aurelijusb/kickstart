<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Kernel;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $json = file_get_contents("https://hw1.nfq2019.online/students.json");
        // $json = utf8_encode($json);
        $data = json_decode($json, true);
        return $this->render('home/index.html.twig', [
            'someVariable' => $data
        ]);
    }
}
