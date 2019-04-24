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
        $name = $request->query->get('name');
        $project = $request->query->get('project');
        $evaluation = 'Gal pasiseks kitą kartą';
        $success = false;
        if ($name === 'Aurimas' && $project === 'nedarykpats')
        {
            $evaluation = 'Dešimt balų';
            $success = true;
        }

        return $this->render('student/index.html.twig', [
            'dataSet' => ['name' => $name,
                'project' => $project,
                'evaluation' => $evaluation,
                'success' => $success],
        ]);
    }
}
