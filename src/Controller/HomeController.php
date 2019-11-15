<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $path = 'https://hw1.nfq2019.online/students.json';
        $content = file_get_contents($path);
        $nfqData = json_decode($content, true);

        $studentsData = $this->groupByStudents($nfqData);
        $projects = $this->getProjectTitle($nfqData);

        return $this->render('home/index.html.twig', [
            'studentsData' => $studentsData,
            'projects' => $projects
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

    private function getProjectTitle(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
                $result[] = ['projectTitle' => $project['name'], 'project' => $projectName];
        }
        return $result;
    }
}
