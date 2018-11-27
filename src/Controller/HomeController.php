<?php

namespace App\Controller;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(KernelInterface $kernel)
    {
        $path = $kernel->getProjectDir();
        $file = file_get_contents($path . '/public/students.json');
        $projects = json_decode($file, true);

        return $this->render('home/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
