<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends Controller
{
    /**
     * @Route("/student", name="student")
     */
    public function index()
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    /**
     * @Route("/validate23/{element}", name="validateStudent")
     * @Method({"POST"})
     * @param Request $request
     * @param $element
     * @return JsonResponse
     */
    public function validate(Request $request, $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];     //['input'] - key in array
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid data', Response::HTTP_BAD_REQUEST]);
        }

        $students = $this->getStudents();     // $students = ['students' => $students, 'teams' => $teams];
        switch ($element) {
            case 'name':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students['students'])]);
                break;

            case 'team':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students['teams'])]);
                break;
        }
        return new JsonResponse(['error' => 'Invalid method', Response::HTTP_BAD_REQUEST]);
    }

    private function getJsonData()
    {
        return /** @lang json */
            '{
          "Po pamok\u0173": {
            "mentor": "Tomas",
            "members": [
              "Elena",
              "Just\u0117",
              "Deimantas"
            ]
          },
          "Tech Guide": {
            "mentor": "Sergej",
            "members": [
              "Matas",
              "Martynas"
            ]
          },
          "Kelion\u0117s draugas": {
            "mentor": "Rokas",
            "members": [
              "Zbignev",
              "Aist\u0117"
            ]
          },
          "Wish A Gift": {
            "mentor": "Aistis",
            "members": [
              "Nerijus",
              "Olga"
            ]
          },
          "Mums pakeliui": {
            "mentor": "Paulius",
            "members": [
              "Egl\u0117",
              "Svetlana"
            ]
          },
          "Motyvacin\u0117 platforma": {
            "mentor": "Audrius",
            "members": [
              "Viktoras",
              "Airidas"
            ]
          }
        }';
    }

    private function getStudents()
    {
        $students = [];
        $teams = [];
        $data = json_decode($this->getJsonData(), true);
        foreach ($data as $key => $teamData) {
            $teams[] = strtolower($key);
            foreach ($teamData['members'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return ['students' => $students, 'teams' => $teams];
    }


}
