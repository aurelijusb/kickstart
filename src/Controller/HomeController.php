<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param KernelInterface $myKernel
     * @return Response
     */

    public function index(KernelInterface $myKernel)
    {
        $studentProjects = json_decode(file_get_contents($myKernel->getProjectDir() . '/public/students.json'), true);

        return $this->render('home/index.html.twig', [
            'array' => $studentProjects
        ]);
    }
}
