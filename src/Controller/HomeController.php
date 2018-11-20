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
     * @param ProjectsData $projects
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProjectsData $projects)
    {
        $webPath = $this->get('kernel')->getProjectDir() . '/public/';
        $projects->setDataFile($webPath.'students.json');
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'projects' => $projects->getData(),
        ]);
    }
}
