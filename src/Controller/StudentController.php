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
        $name = $request->get('name', 'Nenurodytas');
        $team = $request->get('project', 'Nenurodytas');
        return $this->render('student/index.html.twig', [
            'name' => $name,
            'team' => $team,
        ]);
    }
}
