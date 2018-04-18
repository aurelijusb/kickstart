<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationRedirectSubscriber implements EventSubscriberInterface
{
    public function onFosUserRegistrationSuccess($event)
    {
        // ...
    }

    public static function getSubscribedEvents()
    {
        return [
           'fos_user.registration.success' => 'onFosUserRegistrationSuccess',
        ];
    }
}
