<?php

namespace App\Controller;

use App\Services\StudentDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $data = StudentDataService::getData();

        return $this->render('home/index.html.twig', [
            'teams' => $data['teams'],
            'students' => $data['students'],
        ]);
    }
}
