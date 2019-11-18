<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class PeopleController extends AbstractController
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

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
     * @Route("/validate/{element}", name="validatePerson", methods={"POST"})
     */
    public function validate(Request $request, string $element)
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

        return new JsonResponse(['error' => 'Invalid arguments'], Response::HTTP_BAD_REQUEST);
    }

    private function getStudents(): array
    {
        $students = [];
        $storage = json_decode(file_get_contents($this->kernel->getProjectDir(). '/students.json'), true);

        foreach ($storage as $teamData) {
            foreach ($teamData['students'] as $student) {
                $students[] = strtolower($student);
            }
        }

        return $students;
    }
}
