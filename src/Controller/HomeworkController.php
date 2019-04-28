<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeworkController extends AbstractController
{
    /**
     * @Route("/homework", name="homework",)
     */
    public function index()
    {
        return $this->render('homework/index.html.twig', [
            'title' => 'Symfony Second Homework',
        ]);
    }

    /**
     * @Route(
     *     "/validate/{element}",
     *     name="validatePerson",
     *     requirements={"POST"}
     * )
     */

    public function validate(Request $request, string $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $students = $this->getStudents();
        $projects = $this->getProjects();

        switch ($element) {
            case 'name':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
            case 'project':
                return new JsonResponse(['valid' => in_array(strtolower($input), $projects)]);
        }
        return new JsonResponse(['error' => 'Invalid method'],
            Response::HTTP_BAD_REQUEST);
    }

    private function getStorage()
    {
        return /** @lang json */
            '{
	          "nedarykpats": {
	            "name": "Nedaryk pats",
	            "mentors": [
	              "Laurynas"
	            ],
	            "students": [
	              "Martyna",
	              "Aurimas",
	              "Vilius"
	            ]
	          },
	          "savanoryste": {
	            "name": "Car booking",
	            "mentors": [
	              "Tomas"
	            ],
	            "students": [
	              "Ignas",
	              "Dovydas",
	              "Darius"
	            ]
	          },
	          "curlybrackets": {
	            "name": "Maisto dalinimosi sistema",
	            "mentors": [
	              "Paulius"
	            ],
	            "students": [
	              "Roman",
	              "Marijus",
	              "Angelika"
	            ]
	          },
	          "hobby": {
	            "name": "Hobby",
	            "mentors": [
	              "Ieva"
	            ],
	            "students": [
	              "Miroslav",
	              "Viktoras",
	              "Lukas"
	            ]
	          },
	          "hack<b>er</b>\'is po .mySubdomain &project=123": {
	            "name": "\' OR 1 -- DROP DATABASE",
	            "mentors": [
	              "<b>Ponas</b> Programišius"
	            ],
	            "students": [
	              "Aurelijus Banelis",
	              "<b>Ir</b> jo \"geras\" draug\'as"
	            ]
	          }
	        }';
    }

    private function getStudents(): array
    {
        $students = [];
        $storage = json_decode($this->getStorage(), true);
        foreach ($storage as $teamData) {
            foreach ($teamData['students'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return $students;
    }

    private function getProjects(): array
    {
        $projects = [];
        $storage = json_decode($this->getStorage(), true);
        foreach ($storage as $project) {
            $projects[] = strtolower($project);
        }
        return $projects;
    }
}
