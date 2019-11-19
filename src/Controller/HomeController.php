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

        $projectFileName = 'projects.json';
        $projectFilePath = $projectDir . '/public/' . $projectFileName;
        $projectJsonData = file_get_contents($projectFilePath, FILE_USE_INCLUDE_PATH);
        $projectArray = json_decode($projectJsonData, true);

        foreach ($projectArray as $key => $value) {
            $projectArray[$key]['githubDecode'] = urldecode($projectArray[$key]['github']);
            $projectArray[$key]['webDecode'] = urldecode($projectArray[$key]['web']);
        }

        return $this->render('home/index.html.twig', [
            'title' => 'Projektai',
            'studentArray' => $studentArray,
            'projectArray' => $projectArray,
            'studentFileName' => $studentFileName,
        ]);
    }
}
