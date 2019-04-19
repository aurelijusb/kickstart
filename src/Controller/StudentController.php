<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     *
     * @var Request
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->render('student/index.html.twig', [
            'name' => $request->get('name'),
            'project' => $request->get('project'),
        ]);
    }
}
