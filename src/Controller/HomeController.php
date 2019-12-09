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
        $projects = json_decode(file_get_contents($kernel->getProjectDir().'/public/students.json'), true);

        $result=[];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }

        return $this->render('home/index.html.twig', [
            'studentData' => $result,
            'projects' => $projects
        ]);
    }
}
