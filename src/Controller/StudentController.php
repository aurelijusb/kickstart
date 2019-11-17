<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(KernelInterface $request)
    {
        $a = $request->getProjectDir();
        return $this->render('student/index.html.twig', [
            'controller_name' => $a,
            'team_list' => \json_decode(\file_get_contents($a . '/assets/js/students.json'), true)
        ]);
    }
}
