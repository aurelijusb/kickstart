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
        return $this->render('home/index.html.twig', [
            'controller_name' => 'StudentController',
            'teams' => json_decode($this->jsonPath(), true),
        ]);
    }

    /**
     * @Route("students.json", name="student_json")
     */
    public function jsonPath()
    {
        return file_get_contents('students.json');
    }
}
