<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name', 'nenurodyta');
        $project=$request->get('project', 'nenurodyta');


        return $this->render('student/index.html.twig', [
            'name' => $name,
            'project' => $project,
        ]);
    }

    /**
     * @Route("/student/json", name="students-json")
     * @param KernelInterface $kernel
     * @return Response
     */
    public function studentsjson(KernelInterface $kernel)
    {
        $students = json_decode(file_get_contents($kernel->getProjectDir().'/public/students.json'), true);
        return $this->json($students);
    }
}
