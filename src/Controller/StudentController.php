<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/", name="student")
     */
    public function index()
    {
        $data = file_get_contents("https://hw1.nfq2019.online/students.json");
        $data = json_decode($data, true);

        $name = $_GET['name'];
        $project = $_GET['project'];

        $outputProject = '';

        foreach ($data as $key => $value) {
            foreach ($data[$key]['students'] as $testName) {
                if ($testName === $name && $project === $data[$key]['name']) {
                    $outputProject = $key;
                    break;
                }
            }
        }

        return $this->render('student/index.html.twig', [
            'name' => $name,
            'project' => $outputProject,
        ]);
    }
}
