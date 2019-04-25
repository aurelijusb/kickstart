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

        $bigData = file_get_contents('https://nfq190418.realus.website/students.json');
        $projects= json_decode($bigData, true);

        var_dump($projects);
        return $this->render('home/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
