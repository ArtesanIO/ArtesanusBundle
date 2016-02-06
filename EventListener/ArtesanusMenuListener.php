<?php

namespace ArtesanIO\ArtesanusBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Event\ArtesanusMenuEvent;

class ArtesanusMenuListener
{
    private $managers;

    public function __construct($managers)
    {
        $this->managers = $managers;
    }
    /**
     * @param \AppBundle\Event\ConfigureMenuEvent $event
     */
    public function onArtesanusNavBar(ArtesanusMenuEvent $event)
    {
        $menu = $event->getMenu();
        //
        $menu->addChild('Entities', array('route' => 'users'))
        ->setAttribute('dropdown', true)
        ->setAttribute('icon', 'icon-user')
        ->setAttribute('class', 'dropdown-toggle');
        ;

        foreach($this->managers->getManagers() as $manager){
            $menu['Entities']->addChild($manager, array('route' => $manager))
    			->setAttribute('icon', 'icon-edit');
        }


    }
}

?>
