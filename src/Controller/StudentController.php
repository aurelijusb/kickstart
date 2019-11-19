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
        $data = [
            'name' => $request->get('name'),
            'project' => $request->get('project'),
        ];

        return $this->render('student/index.html.twig', [
            'data' => $data,
        ]);
    }
}
