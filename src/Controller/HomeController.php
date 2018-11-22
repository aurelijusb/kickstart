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
        $students = file_get_contents('./students.json');
        $data = json_decode($students, true);

        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }
}
