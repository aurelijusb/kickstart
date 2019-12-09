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
        $jsonContent = file_get_contents("json/students.json");
        $encode = json_decode($jsonContent, true);
        $students = $this->groupByStudents($encode);
        $projects = $this->groupByProject($encode);
        return $this->render('home/index.html.twig', [
            'json' => $students,
            'projectJson' => $projects,
        ]);
    }
    /**
     * @Route("/json", name="json")
     */
    public function returnJson()
    {
        return $this->redirect('json/students.json');
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
    private function groupByProject(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            $result[] = ['project' =>$project['name']];
        }
        return $result;
    }
}
