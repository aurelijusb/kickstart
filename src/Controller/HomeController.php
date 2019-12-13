<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $studentsData = file_get_contents('students.json');
        return $this->render('home/index.html.twig', [
            'students' => $this->groupByStudents(json_decode($studentsData, true)),
            'projects' => $this->groupByTeams(json_decode($studentsData, true)),
        ]);
    }
    private function groupByTeams(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            $result[] = ['name' => $projectName, 'team' => $project['name']];
        }
        return $result;
    }
    private function groupByStudents(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName,
                    'mentors' => $project['mentors']];
            }
        }
        return $result;
    }

    /**
     * @Route("/teamGit/{slug}", name="teamGit")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function teamGit($slug)
    {
        return $this->redirect('https://github.com/nfqakademija/'. $slug);
    }

    /**
     * @Route("/teamWeb/{slug}", name="teamWeb")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function teamWeb($slug)
    {

        //var_dump('https://'. $slug . '.projektai.nfqakademija.lt/');
        return $this->redirect('https://'. htmlspecialchars($slug) . '.projektai.nfqakademija.lt/');

        return $this->redirect($this->generateUrl(
            'teamWeb',
            ['slug' => htmlspecialchars($slug)],
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }
}
