<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
        return $this->render('form/index.html.twig', [
            'name' => $request->get('name', ''),
            'project' => $request->get('project', '')
        ]);
    }
}
