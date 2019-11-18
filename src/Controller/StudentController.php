<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {

        $student = $request->get('name', 'nežinau');
        $project = $request->get('project', 'nežinau');
        return $this->render('student/index.html.twig', ['student' => $student, 'project' => $project
        ]);
    }
}
