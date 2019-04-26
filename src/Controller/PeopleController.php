<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeopleController extends AbstractController
{
    /**
     * @Route("/people", name="people")
     */
    public function index()
    {
        return $this->render('people/index.html.twig', [
            'controller_name' => 'PeopleController',
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
            $input = htmlspecialchars($input,ENT_QUOTES, 'UTF-8');
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        switch ($element) {
            case 'name':
                $students = $this->getStudents();
                return new JsonResponse(['valid' => $this->hasArray($input, $students)]);
            case 'project':
                $projects = $this->getProjects();
                return new JsonResponse(['valid' => $this->hasArray($input, $projects)]);
        }

        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }

    private function hasArray(string $value, array $arr):bool
    {
        return in_array(strtolower($value), $arr);
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
        foreach( $storage as $teamData ){
            $projects[] = strtolower($teamData['name']);
        }
        return $projects;
    }
}
