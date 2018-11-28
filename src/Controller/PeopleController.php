<?php

namespace App\Controller;

use App\Service\DataProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeopleController extends AbstractController
{
    private $dataProvider;

    public function __construct(DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
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
     * @Route("/validate/{element}", name="validate")
     * @Method({"POST"})
     */
    public function validatePerson(Request $request, $element)
    {
        try {
            $input = json_decode($request->getContent(), true)[$element];
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        switch ($element) {
            case 'name':
                $students = $this->dataProvider->getStudents();
                return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
            case 'team':
                $teams = $this->dataProvider->getTeams();
                return new JsonResponse(['valid' => in_array(strtolower($input), $teams)]);
        }

        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }
}
