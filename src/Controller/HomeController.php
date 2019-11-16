<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $array = $this->getJson();

        return $this->render('home/index.html.twig', [
            'data' => $array,
        ]);
    }
    private function getJson(): array
    {
        $data = [];
        $content = file_get_contents("students.json");
        $storage = json_decode($content, true);
        foreach ($storage as $key => $team) {
            $data[$key]['team'] = $key;
            $data[$key]['mentors'] = $team['mentors'];
            $data[$key]['students'] = $team['students'];
            $data[$key]['name'] = $team['name'];
        }
        return $data;
    }

    private function getBrowser()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}
