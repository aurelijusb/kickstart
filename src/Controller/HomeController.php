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
        $json = file_get_contents('https://hw1.nfq2019.online/students.json');
        $projects = json_decode($json, true);
        $students = $this->groupByStudents($projects);
        return $this->render('home/index.html.twig', [
            'students' => $students,
            'projects' => $projects,
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