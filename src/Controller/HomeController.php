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
        $projectDir = $request->getProjectDir();

        $studentFileName = 'students.json';
        $studentFilePath = $projectDir . '/public/' . $studentFileName;
        $studentJsonData = file_get_contents($studentFilePath, FILE_USE_INCLUDE_PATH);
        $studentArray = json_decode($studentJsonData, true);

        return $this->render('home/index.html.twig', [
            'title' => 'Projektai',
            'studentArray' => $studentArray,
            'studentFileName' => $studentFileName,
        ]);
    }
}
