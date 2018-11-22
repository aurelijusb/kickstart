<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller


{

    protected $data = "Matas Kazanavicius";


    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $data = file_get_contents('./data.json');
        $students = json_decode($data, true);

        return $this->render('home/index.html.twig', [
            'data' => $students,
        ]);
    }
}
