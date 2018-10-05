<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StudentasController extends Controller
{
    /**
     * @Route("/studentas2", name="studentas")
     */
    public function index(Request $myRequest)
    {
        $source = $myRequest->get('utm_source', 'Nieko');

        return $this->render('studentas/index.html.twig', [
            'klausimu' => 123,
            'isUrl' => $source,
            'sudetingas' => [
                'vienas',
                'du',
                'trys',
                 "visi ' norintys <b>nualaužti</b> puslapi",
//                file_get_content('mano.html') // Šitam verta būtų naudoti "|raw" twig'e
            ],
        ]);
    }

    /**
     * @Route("/testas/123", name="testas")
     */
    public function testas() {
        return new JsonResponse(['kazkas' => 'veikia']);
    }
    // patogu prasitestuoti su: bin/console debug:router
}
