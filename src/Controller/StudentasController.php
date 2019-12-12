<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentasController extends AbstractController
{
    /**
     * @Route("/studentas", name="studentas")
     */
    public function index(Request $request)
    {
        return $this->render('studentas/index.html.twig', [
            'studentName' => $request->get('student'),
            'projectName' => $request->get('project')
        ]);
    }
}
