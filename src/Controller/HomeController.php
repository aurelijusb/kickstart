<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $data = file_get_contents(dirname(__FILE__) . "/../students.json", FILE_USE_INCLUDE_PATH);
        $data = json_decode($data, true);

        return $this->render('home/index.html.twig', [
            'someVariable' => 'NFQ Akademija',
            'data' => $data,
        ]);
    }
}
