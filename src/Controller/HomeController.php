<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param KernelInterface $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(KernelInterface $request)
    {
        $file = file_get_contents($request->getProjectDir() . '/public/students.json');
        $data = json_decode($file, true);

        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }
}
