<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(Request $request)
    {
        $student = $request->get('name','nenurodyta');
        $project = $request->get('project', 'nenurodyta');
        return $this->render('student/index.html.twig', [
            'student' => $student,
            'project' => $project,
        ]);
    }
}
