<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @var KernelInterface
     * @return Response
     */
    public function index(KernelInterface $kernel)
    {
        $json = file_get_contents($kernel->getProjectDir() .'/public/students.json');
        $data = json_decode($json, true);

        return $this->render('home/index.html.twig', [
            'data' => $data
        ]);
    }
}
