<?php

namespace App\Controller;

use App\Services\TeamsInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/{member}", name="home")
     */
    public function index(string $member = "")
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/member/{member}", name="member")
     */
    public function member(TeamsInterface $teams, string $member = "")
    {
        return $this->render('home/member.html.twig', [
            'member' => $member,
            'team' => $teams->getTeamByMember($member)
        ]);
    }
}
