<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        /*foreach(json_decode($this->getTeams()) as $stud){
            print_r($stud);
        }*/
        return $this->render('home/index.html.twig', [
            'controller_name' => 'StudentController',
            'teams' => json_decode($this->getTeams(), true),
        ]);
    }

    public function getTeams()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://hw1.nfq2019.online/students.json');
        $response->getStatusCode();
        $response->getHeaderLine('application/json; charset=utf8');
        return $response->getBody()->getContents();
    }
}
