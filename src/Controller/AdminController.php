<?php

namespace App\Controller;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(UserInterface $user = null)
    {
        if (!$user) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/review", name="review")
     */
    public function review(UserInterface $user = null)
    {
        if (!$user) {
            $this->redirectToRoute('fos_user_security_login');
        }
        if (in_array('ROLE_MENTORIUS', $user->getRoles())) {
            return $this->render('admin/review.html.twig');
        }
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return $this->render('admin/plan.html.twig');
        }
        // Design system to not reach this line: produce HTTP 500 response
        throw new AccessDeniedException('User not authorised by known roles');
    }
}
