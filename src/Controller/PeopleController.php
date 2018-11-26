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
     * @Route("/validate/{element}", name="validatePerson")
     * @Method({"POST"})
     */
    public function validate(Request $request, $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $students = $this->getStudents();
        switch ($element) {
            case 'name':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
        }

        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
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
}
