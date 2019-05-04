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
    public function index(KernelInterface $kernel)
    {
        $jsonFileName = '/students.json';
        $dataSetLocation = $kernel->getProjectDir() . '/public' . $jsonFileName;
        $dataSet = json_decode(file_get_contents($dataSetLocation), true);
        return $this->render('home/index.html.twig', [
            'dataSet' => $dataSet,
            'dataSetLocation' => $jsonFileName
        ]);
    }
}
