<?php

namespace App\EventSubscriber;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class RegistrationRedirectSubscriber implements EventSubscriberInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onFosUserRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate('admin');
        $respononse = new RedirectResponse($url);
        $event->setResponse($respononse);
    }

    /**
     * @see RegistrationController::registerAction()
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onFosUserRegistrationSuccess',
        ];
    }
}
