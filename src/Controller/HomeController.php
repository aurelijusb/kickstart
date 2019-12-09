<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(KernelInterface $request)
    {
        $json = file_get_contents($request->getProjectDir() . '/public/students.json');
        $data = json_decode($json, true);
        return $this->render('home/index.html.twig', [
            'students' => $this->groupByStudents($data),
            'projects' => $this->groupByTeam($data),
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

    private function groupByTeam(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            $result[] = ['projectName' => $projectName, 'teamName' => $project['name']];
        }
        return $result;
    }
}
