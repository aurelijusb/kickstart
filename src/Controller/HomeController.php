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
        $content = file_get_contents("students.json");
        $data = json_decode($content, true);

        return $this->render('home/index.html.twig', ["data" => $data]);
    }
}
