<?php
declare(strict_types=1);
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function index(): Response
    {

        $client = HttpClient::create();
        $response = $client->request('GET', 'https://hw1.nfq2019.online/students.json');

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];

        $contentJson = "";
        if ($statusCode === 200 && $contentType === "application/json") {
            $contentJson = $response->toArray();
        }

        $projects = $this->groupByProjects($contentJson);
        $teams = $this->groupByTeams($contentJson);

        return $this->render('home/index.html.twig', [
            'someVariable' => 'NFQ Akademija',
            'title' => "Projektai",
            'projects' => $projects,
            'teams' => $teams,
        ]);
    }

    /**
     * @param $contentJson
     * @return array
     */
    private function groupByProjects($contentJson): array
    {
        $array = array_combine(array_keys($contentJson), array_column($contentJson, 'name'));

        return $array;
    }

    /**
     * @param $contentJson
     * @return array
     */
    private function groupByTeams($contentJson): array
    {
        $array = [];
        foreach ($contentJson as $key => $value) {
            foreach ($value as $keyItem => $valueItem) {
                if ($keyItem === "mentors") {
                    if (is_array($valueItem)) {
                        foreach ($valueItem as $mentor) {
                            $array[$key]['mentors'][] = $mentor;
                        }
                    }
                }

                if ($keyItem === "students") {
                    if (is_array($valueItem)) {
                        foreach ($valueItem as $student) {
                            $array[$key]['students'][] = $student;
                        }
                    }
                }
            }
        }

        return $array;
    }
}