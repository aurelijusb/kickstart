<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $finder = new Finder();
        $finder->files()->in('../public')->name('students.json');
   
        foreach ($finder as $file) {
            $content = file_get_contents($file);
            $data = json_decode($content, true);
        }

        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }
}
