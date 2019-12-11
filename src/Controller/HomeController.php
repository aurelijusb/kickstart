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
        $data = $this->getDataFromJson($request->getProjectDir().'/public/students.json');

        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }

    private function getDataFromJson($file)
    {
        $json_data = file_get_contents($file);
        return json_decode($json_data, true);
    }
}
