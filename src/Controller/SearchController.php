<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request)
    {

        $temp = $request->getRequestUri();
        $path = substr($temp, strlen($request->getPathInfo()) + 1, strlen($temp));
        $pos = strpos($path, '&');
        $member = substr($path, 0, $pos);
        $team = substr($path, $pos + 1, strlen($path));

        $pos = strpos($member, '=');
        $member = substr($member, $pos + 1, strlen($member));
        $pos = strpos($team, '=');
        $team = substr($team, $pos + 1, strlen($team));

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'team' => $team,
            'member' => $member
        ]);
    }
}
