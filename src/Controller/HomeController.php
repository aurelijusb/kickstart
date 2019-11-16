<?php

namespace App\Controller;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
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
        $studentList = array();
        $studentsJson = file_get_contents('students.json');
        $students = json_decode($studentsJson, true);
        foreach ($students as $key => $student) {
            foreach ($student["students"] as $oneStudent) {
                array_push($studentList, array($oneStudent, $student["mentors"][0], $key));
            }
        }

        $repositoriesList = array();

        foreach ($students as $key => $student) {
            array_push($repositoriesList, array($key, $student["name"]));
        }

        return $this->render('home/index.html.twig', [
            'someVariable' => $studentList,
            'repositories' => $repositoriesList
        ]);
    }
}
