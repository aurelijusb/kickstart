<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(KernelInterface $request, Request $req)
    {
        $student_name = $req->get('name', 'Nenurodytas');
        $project_name = $req->get('project', 'Nenurodytas');

        $a = $request->getProjectDir();


        $studentProjects = \json_decode(\file_get_contents($a . '/assets/js/students.json'), true);
        $found = false;
        foreach ($studentProjects as $project) {
            foreach ($project['students'] as $student) {
                if ($student == $student_name) {
                    $found = true;
                    $project_name = $project['name'];
                    break 2;
                }
            }
        }
        if ($found == false) {
            $student_name = 'Nenurodytas';
            $project_name = 'Nenurodytas';
        }
        if ($student_name == 'Diana') {
            $good_student = true;
        } else {
            $good_student = false;
        }

        return $this->render('student/entry.html.twig', [
            'project' => $project_name,
            'student' => $student_name,
            'zaza' => $good_student
        ]);
    }
}
