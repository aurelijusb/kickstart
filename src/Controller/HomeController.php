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
        $data = json_decode(file_get_contents('../public/students.json'), true);
        $only_values = array_values($data);
        $students = array_map(function ($team){
            return $team['students'];
        }, $only_values);
        $team_names = array_map(function ($team){
            return $team['name'];
        }, $only_values);
        $mentors = array_map(function ($team){
            return $team['mentors'][0];
        }, $only_values);
        $teams = array_keys($data);
        return $this->render('home/index.html.twig', [
            'students' => $students,
            'team_names' => $team_names,
            'mentors' => $mentors,
            'teams' => $teams,
        ]);
    }

    
}
