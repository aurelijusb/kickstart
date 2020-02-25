<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
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
    public function validate(KernelInterface $kernelInterface, Request $request, string $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $students = $this->getStudents($kernelInterface);
        $teams = $this->getTeams($kernelInterface);
        switch ($element) {
            case 'name':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
            case 'team':
                return new JsonResponse(['valid' => in_array(strtolower($input), $teams)]);
        }

        return new JsonResponse(['error' => 'Invalid arguments'], Response::HTTP_BAD_REQUEST);
    }

    private function getStorage(KernelInterface $kernelInterface)
    {
        $projectDir = $kernelInterface->getProjectDir();

        $storageFileName = 'storage.json';
        $storageFilePath = $projectDir . '/public/' . $storageFileName;
        $storageJsonData = file_get_contents($storageFilePath, FILE_USE_INCLUDE_PATH);
        $storageArray = json_decode($storageJsonData, true);

        return $storageArray;
    }

    private function getStudents(KernelInterface $kernelInterface): array
    {
        $students = [];
        $storage = $this->getStorage($kernelInterface);
        foreach ($storage as $teamData) {
            foreach ($teamData['students'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return $students;
    }

    private function getTeams(KernelInterface $kernelInterface): array
    {
        $teams = [];
        $storage = $this->getStorage($kernelInterface);
        foreach ($storage as $key => $value) {
            $teams[] = strtolower($key);
        }
        return $teams;
    }
}
