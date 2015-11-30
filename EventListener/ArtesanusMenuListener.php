<?php

namespace ArtesanIO\ArtesanusBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Event\ArtesanusMenuEvent;

class ArtesanusMenuListener
{
    /**
     * @param \AppBundle\Event\ConfigureMenuEvent $event
     */
    public function onArtesanusNavBar(ArtesanusMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('ACL', array('route' => 'artesanus_console_acl_users'));
        $menu->addChild('Storage Media', array('route' => 'artesanus_console_storage'));
    }
}

?>
