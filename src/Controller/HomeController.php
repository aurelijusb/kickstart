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
    public function index(KernelInterface $kernel)
    {
        $dataFile = file_get_contents($kernel->getProjectDir() . '/public/students.json');
        $projects = json_decode($dataFile, true);
        $students = $this->groupByStudents($projects);

        return $this->render('home/index.html.twig', [
            'someVariable' => 'NFQ Akademija',
            'projects' => $projects,
            'students' => $students,
        ]);
    }

    private function groupByStudents(array $projects) {
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[$student] = ['project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $result;
    }
}
