<?php

namespace ArtesanIO\ArtesanusBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ArtesanIO\ArtesanusBundle\ArtesanusEvents;
use ArtesanIO\ArtesanusBundle\Event\ArtesanusRolesEvent;

class ArtesanusRolesListener implements EventSubscriberInterface
{

    public function roles(ArtesanusRolesEvent $event)
    {
        $roles = $event->getRoles();
        $roles->createRole(array('ROLE_ADMIN', array('role' => 'Admin', 'description' => 'User Admin', 'login_route_success' => 'artesanus_console_acl_users')));
        $roles->createRole(array('ROLE_AUTHENTICATED', array('role' => 'Authenticated', 'description' => 'User Authenticated', 'login_route_success' => 'artesanus_front_user_profile')));
    }

    public static function getSubscribedEvents()
    {
        return array(
            ArtesanusEvents::ARTESANUS_ROLES => 'roles',
        );
    }

}



?>
