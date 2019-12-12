<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function studentCheck(Request $req)
    {
        $success = false;

        $name = $req->query->get('name');
        $team = $req->query->get('project');

        if ($name == 'Nojus' && $team == 'activegen') {
            $success = true;
        }

        return $this->render('student/index.html.twig', [
            'success' => $success,
            'student' => $name,
            'team' => $team,
        ]);
    }
}
