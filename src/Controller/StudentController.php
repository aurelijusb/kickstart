<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $student = $request->get('student');
        $project = $request->get('project');

        return $this->render('student/index.html.twig', [
            'student' => $student,
            'project' => $project,
        ]);
    }
}
