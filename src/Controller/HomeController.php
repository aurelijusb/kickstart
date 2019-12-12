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

        $data= file_get_contents('https://hw1.nfq2019.online/students.json');
        $obj = json_decode($data);

        $result = [];
        foreach ($obj as $key => $students) {
            foreach ($students->students as $student) {
                $result[] = ['name' => $student, 'mentor' => $students->mentors[0], 'sortName' => $key];
            }
        }

        $result2 = [];
        foreach ($obj as $key => $projects) {
                $result2[] = ['sortName' => $key, 'fullProjectName' => $projects->name];
        }

        return $this->render('home/index.html.twig', [

            'students' =>
                $result
            ,
            'projects' =>
                $result2
            ,
        ]);
    }
}
