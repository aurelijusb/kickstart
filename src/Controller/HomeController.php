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
        $teams = $this->groupByTeams($studentProjects);

        return $this->render('home/index.html.twig', [
            'students' => $students,
            'projects' => $teams,
        ]);
    }

    private function groupByStudents(array $projects)
    {
        $students = [];

        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $students[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors'][0]];
            }
        }
        return $students;
    }

    private function groupByTeams(array $projects)
    {
        $teams = [];

        foreach ($projects as $projectName => $project) {
            $teams[] = ['name' => $projectName, 'team' => $project['name']];
        }
        return $teams;
    }
}
