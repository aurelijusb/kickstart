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
        $file = file_get_contents('students.json', FILE_USE_INCLUDE_PATH);
        $info = json_decode($file, true);

        return $this->render('home/index.html.twig', [
            'array' => $info
        ]);
    }
}
