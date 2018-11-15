<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends Controller
{
    /**
     * @Route("/student", name="student")
     */
    public function student(Request $request)
    {
        $name = $request->query->get('name');
        $project = $request->query->get('project');

        return $this->render('student/student.html.twig', [
            'name' => $name,
            'project' => $project
        ]);
    }
}
