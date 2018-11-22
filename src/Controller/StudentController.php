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
    public function index(Request $request)
    {
        $projectName = $request->get('project');
        $studentName = $request->get('name');

        return $this->render('student/student.html.twig', [
            'name' => $studentName,
            'project' => $projectName
        ]);
    }
}
