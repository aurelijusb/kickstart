<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentWorkController extends AbstractController
{
    /**
     * @Route("/student/work", name="student_work")
     */
    public function index()
    {
        return $this->render('student_work/index.html.twig', [
            'controller_name' => 'StudentWorkController',
        ]);
    }
}
