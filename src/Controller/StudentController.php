<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/", name="student")
     */
    public function studentAccount(Request $request)
    {
        $name = $request->get('name');
        $project = $request->get('project');

        return $this->render('home/student.html.twig', [
            'name' => $name,
            'project' => $project
        ]);
    }

    /**
     * @Route("/students.json", name="students_json")
     */
    public function showJson(KernelInterface $kernel)
    {
        $json = json_decode(file_get_contents($kernel->getProjectDir() . '/students.json'));

        return new JsonResponse($json);
    }
}
