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

        $group = $this->groupByStudents();
        $projects = $this->getProjects();
        return $this->render('home/index.html.twig', ['group' => $group, 'projects' => $projects]);
    }

    protected function getProjects()
    {
        $projects = $this->getProjectData();
        $result = [];
        foreach ($projects as $projectName => $project) {
            if (!in_array($projectName, $result)) {
                $result[] = ['project' => $projectName, 'name' => $project['name']];
            }
        }
        return $result;
    }


    private function getProjectData()
    {
        $projectFile = file_get_contents('../public/students.json');
        $projects = json_decode($projectFile, true);
        return $projects;
    }

    private function groupByStudents()
    {
        $projects = $this->getProjectData();
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $result;
    }
}
