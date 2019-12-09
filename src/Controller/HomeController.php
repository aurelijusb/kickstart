<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $jsonContent = file_get_contents("json/students.json");
        $encode = json_decode($jsonContent, true);
        $students = $this->groupByStudents($encode);
        $projects = $this->groupByProject($encode);
        return $this->render('home/index.html.twig', [
            'json' => $students,
            'projectJson' => $projects,
        ]);
    }
    /**
     * @Route("/json", name="json")
     */
    public function returnJson()
    {
        return $this->redirect('json/students.json');
    }
    /**
     * @Route("/github", name="github")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function retrunGithub(Request $request)
    {
        return $this->redirect('https://github.com/nfqakademija/'.$request->get('param', ''));
    }
    /**
     * @Route("/web", name="web")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function returnWeb(Request $request)
    {
        return $this->redirect('http://'.$request->get('param', '').'.projektai.nfqakademija.lt/');
    }

    private function groupByStudents(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $result;
    }
    private function groupByProject(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            $result[] = ['projectName' =>$project['name'], 'project' => $projectName];
        }
        return $result;
    }
}
