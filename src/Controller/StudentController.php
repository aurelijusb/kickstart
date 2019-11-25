<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     */
    public function index(Request $request)
    {
        $student = $request->query->get('student', 'Nope');
        $project = $request->query->get('project', 'Nope');
        return $this->render('student/index.html.twig', [
            'student' => $student,
            'project' => $project,
        ]);
    }
}