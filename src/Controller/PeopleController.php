<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
     *     methods={"POST"}
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
        $teams = $this->getTeams();
        switch ($element) {
            case 'name':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
            case 'team':
                return new JsonResponse(['valid' => in_array(strtolower($input), $teams)]);
        }
        return new JsonResponse(['error' => 'Invalid arguments'], Response::HTTP_BAD_REQUEST);
    }
    private function getStudents(): array
    {
        $json = file_get_contents('https://hw1.nfq2019.online/students.json');       
        $students = [];
        $storage = json_decode($json, true);
        foreach ($storage as $teamData) {
            foreach ($teamData['students'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return $students;
    }
    private function getTeams(): array
    {
        $json = file_get_contents('https://hw1.nfq2019.online/students.json');       
        $teams = [];
        $storage = json_decode($json, true);
        foreach ($storage as $name => $teamData) {
            $teams[] = strtolower($name);
        }
        return $teams;
    }
}
    