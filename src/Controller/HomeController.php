<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param KernelInterface $request
     * @return Response
     */
    public function index(KernelInterface $request)
    {
        $filedir = $request->getProjectDir().'/public/students.json';
        $data = file_get_contents($filedir);
        $projects = json_decode($data, true);

        $result = [];
        $result2 = [];
        foreach ($projects as $projectName => $project) {
            $result2[] = ['description' => $project['name'], 'project' => $projectName];
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }

        return $this->render('home/index.html.twig', [
            'result' => $result,
            'result2' => $result2,
        ]);
    }
}
