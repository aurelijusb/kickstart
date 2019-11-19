<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(KernelInterface $request)
    {
        $data = file_get_contents($request->getProjectDir() . '/public/students.json');
        $projects = json_decode($data, true);
        return $this->render('home/index.html.twig', [
            'projects' => $projects
        ]);
    }
}
