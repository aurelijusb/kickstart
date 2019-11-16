<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{

    /**
     * @Route("/student", name="showStudent")
     */
    public function showStudent(Request $request)
    {
        return $this->render('home/showstudent.html.twig', [
            'someVariable' => [
                $request->get('name', ''),
                $request->get('project', '')
            ],
        ]);
    }
}
