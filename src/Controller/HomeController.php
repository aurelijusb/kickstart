<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(KernelInterface $request)
    {
        $json = file_get_contents($request->getProjectDir() . '/public/students.json');
        $data = json_decode($json, true);
        return $this->render('home/index.html.twig', [
            'someVariable' => 'NFQ akademija',
            'data' => $data
        ]);
    }
}
