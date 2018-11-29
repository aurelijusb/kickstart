<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\ProjectsData;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $webPath = $this->get('kernel')->getProjectDir() . '/public/';
        $projects = new ProjectsData($webPath.'students.json');
        
        return $this->render('home/index.html.twig', [
            'projects' => $projects->getData(),
        ]);
    }
}
