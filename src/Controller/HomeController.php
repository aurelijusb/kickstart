<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param KernelInterface $request
     * @return Response
     */
    public function index(KernelInterface $request)
    {
        $studentProjects = json_decode(file_get_contents($request->getProjectDir() . '/public/students.json'), true);
        $students = $this->groupByStudents($studentProjects);

        return $this->render('home/index.html.twig', [
            'students' => $students,
            'projects' => $studentProjects,
        ]);
    }

    private function groupByStudents(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $result;
    }
}
