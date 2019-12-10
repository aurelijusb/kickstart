<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student")
     */
    public function index(Request $request)
    {
        $name = $request->get('name', 'nenurodyta');
        $team = $request->get('project', 'nenurodyta');
        $success = (bool)random_int(0, 1);

        return $this->render('student/index.html.twig', [
            'name' => $name,
            'team' => $team,
            'success' => $success,
        ]);
    }
}
