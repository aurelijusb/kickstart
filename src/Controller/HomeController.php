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

        $data = file_get_contents("students.json");
        $teams = json_decode($data, true);

        return $this->render('home/index.html.twig', ["teams" => $teams]);
    }
}
