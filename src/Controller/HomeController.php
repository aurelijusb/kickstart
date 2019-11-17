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
        $newf = file_get_contents('https://hw1.nfq2019.online/students.json');
        $decoded_file = json_decode($newf, true);

        return $this->render('home/index.html.twig', [
            'someVariable' => $decoded_file,
        ]);
    }
}
