<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $json = file_get_contents(__DIR__ . '/../../public/students.json', FILE_USE_INCLUDE_PATH);
        $data = json_decode($json, true);

        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }
}
