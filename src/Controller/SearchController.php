<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $project = $request->get('project');
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'name' => $name,
            'project' => $project
        ]);
    }
}
