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
        $studentsJson = file_get_contents('students.json');
        $students = json_decode($studentsJson, true);


        return $this->render('home/index.html.twig', [
            'students' => $students,
        ]);
    }
}
