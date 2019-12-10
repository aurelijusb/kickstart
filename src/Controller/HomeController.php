<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request): Response
    {
        $json = file_get_contents('./../public/students.json');
        $projects = json_decode($json, true);
        $students = $this->groupByStudents($projects);

        $name = $request->get('name');
        $project = $request->get('project');

        if (isset($name) || isset($project)) {
            return $this->student($request);
        } else {
            return $this->render('home/index.html.twig', [
                'students' => $students,
                'projects' => $projects,
            ]);
        }
    }

    public function student(Request $request): Response
    {
        $name = $request->get('name', 'nenurodyta');
        $team = $request->get('project', 'nenurodyta');
        $success = (bool)random_int(0, 1);

        return $this->render('student/index.html.twig', [
            'name' => $name,
            'team' => $team,
            'success' => $success,
        ]);
    }

    private function groupByStudents(array $projects): array
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
