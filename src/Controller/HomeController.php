<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $projects = json_decode(file_get_contents('../public/students.json'), true);
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
