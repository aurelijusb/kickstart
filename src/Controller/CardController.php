<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/studentas", name="student")
     * @param Request $request
     */
    public function index(Request $request)
    {
        $student = urldecode($request->query->get('name'));
        $project = urldecode($request->query->get('project'));
        $evaluation = 'Gal pasiseks kitą kartą';

        if ($student === 'Andrius' && $project === 'NFQ Career Criteria Assessment') {
            $evaluation = 'Dešim balų';
        }

        return $this->render('studentas/index.html.twig', [
            'student' => $student,
            'project' => $project,
            'evaluation' => $evaluation,
            'title' => 'Projektai',
        ]);
    }
}
