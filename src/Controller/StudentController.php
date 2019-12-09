<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     */
    public function index(Request $request)
    {
        $name = $request->query->get('name', 'Nenurodytas');
        $project = $request->query->get('project', 'Nenurodytas');

        return $this->render('student/index.html.twig', [
            'name' => $name,
            'project' => $project,
            'title' => 'Vertinimas',
        ]);
    }
}
