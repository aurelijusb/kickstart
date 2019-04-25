<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ListController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */

    public function index(Request $request)
    {
        $info['vardas'] = $request->get('name');
        $info['projektas'] = $request->get('project');

        return $this->render('student/index.html.twig', [
            'info' => $info,
        ]);
    }
}