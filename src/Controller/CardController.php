<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $student = urldecode($request->query->get('name'));
        $project = urldecode($request->query->get('project'));
        $success = false;

        if ($student === 'Andrius' && $project === 'career') {
            $success = true;
        }

        return $this->render('student/index.html.twig', [
            'student' => $student,
            'project' => $project,
            'success' => $success,
            'title' => 'Projektai',
        ]);
    }
}
