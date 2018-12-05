<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/validate/{element}", name="validateElement")
     * @Method({"POST"})
     */
    public function validate(Request $request, $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }
        
        switch ($element) {
            case 'name':
                $students = $this->getStudents();
                return new JsonResponse(['valid' => in_array($this->stringToLower($input), $students)]);
            
            case 'project':
                $projects = $this->getProjects();
                return new JsonResponse(['valid' => in_array($this->stringToLower($input), $projects)]);
        }
        
        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }
    
    private function getStudents(): array
    {
        $students = [];
        $storage = json_decode($this->getStorage(), true);
        if ($storage === null) {
            $storage = [];
        }
        foreach ($storage as $teamData) {
            foreach ($teamData['students'] as $student) {
                $name = $this->stringToLower($student);
                $students[] = $name;
            }
        }
        return $students;
    }
    
    private function getProjects(): array
    {
        $storage = json_decode($this->getStorage(), true);
        if ($storage === null) {
            $storage = [];
        }
        $projects = array_map([$this, 'stringToLower'], array_keys($storage));
        return $projects;
    }
    
    private function stringToLower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }
    
    private function getStorage()
    {
        return /** @lang json */
            '{
          "knygnesiai": {
            "name": "Knygų mainai",
            "mentors": [
              "Karolis"
            ],
            "students": [
              "Mindaugas",
              "Tadas"
            ]
          },
          "carbooking": {
            "name": "Car booking",
            "mentors": [
              "Monika",
              "Tomas"
            ],
            "students": [
              "Matas",
              "Adomas",
              "Aidas"
            ]
          },
          "academyui": {
            "name": "NFQ Akademijos puslapis",
            "mentors": [
              "Tomas"
            ],
            "students": [
              "Indrė"
            ]
          },
          "buhalteriui": {
            "name": "Pagalba buhalteriui",
            "mentors": [
              "Aistis"
            ],
            "students": [
              "Geraldas",
              "Matas"
            ]
          },
          "mapsportas": {
            "name": "Sporto draugas",
            "mentors": [
              "Agnis"
            ],
            "students": [
              "Mantas",
              "Pijus"
            ]
          },
          "trainme": {
            "name": "Asmeninio trenerio puslapis",
            "mentors": [
              "Laurynas"
            ],
            "students": [
              "Ignas",
              "Gintautas"
            ]
          }
        }';
    }
}

