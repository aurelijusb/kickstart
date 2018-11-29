<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
    private $studentName = 'Matas Kulingauskas';
    
    /**
     * @Route("/student", name="student")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $projectKey = $request->get('project', '');
        $studentName = $request->get('name', '');
        $graduated = ($this->studentName === $studentName);
        
        return $this->render('student/index.html.twig', [
            'project_key' => $projectKey,
            'student_name' => $studentName,
            'graduated' => $graduated,
        ]);
    }
}
