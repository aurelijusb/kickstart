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
        $getList = file_get_contents(__DIR__.'/../../students.json');
        $info = json_decode($getList, true);

        return $this->render('home/index.html.twig', [
            'info' => $info
        ]);
    }
}
