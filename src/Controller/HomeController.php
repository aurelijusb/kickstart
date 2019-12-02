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
        $json = file_get_contents($kernel->getProjectDir().'/public/students.json');
        if (false === $json) {
            throw \Exception("Unable to read internal file");
        }
        $data = json_decode($json, true);

        $projects = $students = [];
        foreach ($data as $projectDomain => $items) {
            $projects[] = ['domain' => $projectDomain, 'name' => $items['name']];
            foreach ($items['students'] as $student) {
                $students[] = ['name' => $student, 'mentors' => $items['mentors'], 'project' => $projectDomain];
            }
        }

        return $this->render('home/index.html.twig', [
            'title' => 'Projektai',
            'projects' => $projects,
            'students' => $students,
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
            'project' => $request->get('project', ''),
            'name' => $request->get('name', ''),
        ];
        $data['isGoodStudent'] = ('myfleet' === $data['project'] && 'Artūras' === $data['name']);
        return $this->render('home/view.html.twig', [
            'title' => 'Vertinimas',
            'student' => $data,
        ]);
    }
}
