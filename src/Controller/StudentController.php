<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(Request $request)
    {
        $file = file_get_contents('data.json', FILE_USE_INCLUDE_PATH);
        $info = json_decode($file, true);
        $id = substr($request->getRequestUri(), strlen($request->getPathInfo()) + 1, strlen($request->getRequestUri()));
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'id' => $id,
            'array' => $info,
            'arentas' => 21
        ]);
    }
}
