<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function onEasyAdminPreUpdate($event)
    {
        // ...
    }

    public static function getSubscribedEvents()
    {
        return [
           'easy_admin.pre_update' => 'onEasyAdminPreUpdate',
        ];
    }
}
