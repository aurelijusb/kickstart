<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentsJSONController extends AbstractController
{
    /**
     * @Route("/students.json", name="studentsjson")
     */
    public function index()
    {
        $response = new Response(file_get_contents(dirname(__FILE__) . "/../students.json", FILE_USE_INCLUDE_PATH));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
