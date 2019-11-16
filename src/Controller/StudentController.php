<?php

namespace App\Controller;


use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
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
     * @Route(
     *     "/validate/{element}",
     *     name="validatePerson",
     *     methods={"POST"}
     * )
     * @param Request $request
     * @param KernelInterface $kernel
     * @param string $element
     * @return JsonResponse
     */
    public function validate(Request $request, KernelInterface $kernel, string $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $file = file_get_contents($kernel->getProjectDir() . '/public/students.json');
        $storage = json_decode($file, true);

        switch ($element) {
            case 'name':
                $students = $this->parseStudents($kernel, $storage);
                return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
            case 'team':
                $teams = $this->parseTeams($kernel, $storage);
                return new JsonResponse(['valid' => in_array(strtolower($input), $teams)]);
        }


        return new JsonResponse(['error' => 'Invalid arguments'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param KernelInterface $kernel
     * @param $storage
     * @return array
     */
    private function parseTeams(KernelInterface $kernel, $storage): array
    {
        $teams = [];
        foreach ($storage as $key => $teamData) {
            $teams[] = strtolower($key);
        }
        return $teams;

    }

    /**
     * @param KernelInterface $kernel
     * @param $storage
     * @return array
     */
    private function parseStudents(KernelInterface $kernel, $storage): array
    {
        $students = [];
        foreach ($storage as $teamData) {
            foreach ($teamData['students'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return $students;
    }
}
