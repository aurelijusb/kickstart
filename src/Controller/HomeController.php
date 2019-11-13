<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="student_list")
     * @param KernelInterface $kernel
     * @return Response
     */
    public function index(KernelInterface $kernel)
    {
        $json = (string)file_get_contents($kernel->getProjectDir().'/public/students.json');
        $data = json_decode($json, true);

        return $this->render('home/index.html.twig', [
            'title' => 'Projektai',
            'teams' => $data,
        ]);
    }

    /**
     * @Route("/student", name="student_view")
     * @param Request $request
     * @return Response
     */
    public function view(Request $request)
    {
        $data = [
            'project' => $request->get('project'),
            'name' => $request->get('name'),
        ];
        return $this->render('home/view.html.twig', [
            'title' => 'Vertinimas',
            'student' => $data,
        ]);
    }
}
