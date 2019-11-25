<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param KernelInterface $kernel
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(KernelInterface $kernel)
    {
        $projects = json_decode(file_get_contents($kernel->getProjectDir() . '/public/students.json'), true);

        $students = $this->groupByStudents($projects);
        return $this->render('home/index.html.twig', [
            'someVariable' => $students,
            'projects' => $projects
        ]);
    }

    private function groupByStudents(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentor' => $project['mentors'][0]];
            }
        }
        return $result;
    }
}
