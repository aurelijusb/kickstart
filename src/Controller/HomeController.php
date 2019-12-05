<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param KernelInterface $request
     */
    public function index(KernelInterface $request)
    {
        set_include_path($request->getProjectDir() . '/public/students.json');

        $projects = json_decode(file_get_contents(get_include_path()), true);
        $students = $this->groupByStudents($projects);

        return $this->render('home/index.html.twig', [
            'students' => $students,
            'projects' => $projects,
            'title' => 'Projektai'
        ]);
    }

    private function groupByStudents(array $projects)
    {
        $students = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $students[] = [
                    'name' => $student,
                    'project' => $projectName,
                    'mentors' => $project['mentors']
                ];
            }
        }

        return $students;
    }
}
