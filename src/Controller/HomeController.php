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
        $dataArray = json_decode(file_get_contents('https://hw1.nfq2019.online/students.json'), true);

        return $this->render('home/index.html.twig', [
            'dataArray' => $dataArray,
        ]);
    }
}