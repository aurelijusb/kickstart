<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\ProjectsData;
use Symfony\Component\HttpKernel\KernelInterface;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @param KernelInterface $kernel
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(KernelInterface $kernel)
    {
        $webPath = $kernel->getProjectDir() . '/public/';
        $projects = new ProjectsData($webPath . 'students.json');
        
        return $this->render('home/index.html.twig', [
            'projects' => $projects->getData(),
        ]);
    }
}
