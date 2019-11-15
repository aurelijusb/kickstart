<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param KernelInterface $kernel
     * @return Response
     */
    public function index(KernelInterface $kernel)
    {
        $teams = json_decode(file_get_contents($kernel->getProjectDir().'/public/students.json'), true);
        $students = [];
        foreach ($teams as $teamName => $team) {
            foreach ($team['students'] as $student) {
                $students[] = [
                    'student' => $student,
                    'project' => $teamName,
                    'mentors' => $team['mentors']
                ];
            }
        }

        return $this->render('home/index.html.twig', [
            'students' => $students,
            'projects' => $teams,
        ]);
    }
}
