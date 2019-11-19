<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $project=$request->get('project');
        $myName = false;

        if($name == 'Ričardas')
        {
            $myName=true;
        }

        return $this->render('student/index.html.twig', [
            'name' => $name,
            'project' => $project,
            'myName' => $myName
        ]);
    }
}
