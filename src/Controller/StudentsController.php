<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentsController extends AbstractController
{
    /**
     * @Route("/", name="students")
     */
    public function index()
    {
        $studentsJson = file_get_contents('students.json');
        $students = json_decode($studentsJson, true);

        return $this->render('students/index.html.twig', [
            'students' => $students,
        ]);
    }
}
