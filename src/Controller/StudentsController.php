<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentsController extends AbstractController
{
    /**
     * @Route("/student", name="students", methods="GET")
     */
    public function show(Request $request)
    {
        return $this->render('students/index.html.twig', [
            'student' => $request->get('name',''),
            'project' => $request->get('project',''),
        ]);
    }
}
