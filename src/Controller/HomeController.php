<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class  HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $jsonContent = file_get_contents("https://hw1.nfq2019.online/students.json");
        $encode = json_decode($jsonContent, true);
        $array = (array) $encode;
        $sutends = $this->groupByStudents($encode);
        return $this->render('home/index.html.twig', [
            'json' => $sutends,
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
