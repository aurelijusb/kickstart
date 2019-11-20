<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $data = file_get_contents('students.json');
        $projects = json_decode($data, true);

        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
//                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
                $result[] = $student;
            }
        }

        return $this->render('home/index.html.twig',
            [
                'someVariable' => $result
            ]);
    }
}
