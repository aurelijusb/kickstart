<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/", name="student")
     */
    public function index(Request $request)
    {
        $data = file_get_contents(dirname(__FILE__) . "/../students.json", FILE_USE_INCLUDE_PATH);
        $data = json_decode($data, true);

        $name = $request->query->get('name');
        $project = $request->query->get('project');

        $outputProject = '';

        foreach ($data as $key => $value) {
            foreach ($data[$key]['students'] as $testName) {
                if ($testName === $name && $project === $data[$key]['name']) {
                    $outputProject = $key;
                    break;
                }
            }
        }

        return $this->render('student/index.html.twig', [
            'name' => $name,
            'project' => $outputProject,
        ]);
    }
}
