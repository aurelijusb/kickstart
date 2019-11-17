<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/studentas", name="student")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $student = urldecode($request->query->get('name'));
        $project = urldecode($request->query->get('project'));
        $success = false;

        if ($student === 'Andrius' && $project === 'NFQ Career Criteria Assessment') {
            $success = true;
        }

        return $this->render('studentas/index.html.twig', [
            'student' => $student,
            'project' => $project,
            'success' => $success,
            'title' => 'Projektai',
        ]);
    }
}
