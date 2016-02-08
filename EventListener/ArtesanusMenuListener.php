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

        foreach($this->managers->getManagers() as $p => $packages){
            if(!is_int($p)){

                $p = ucwords($p);

                $menu->addChild($p, array())
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user')
                ->setAttribute('class', 'dropdown-toggle');
                ;

                foreach($packages as $i => $item){
                    $menu[$p]->addChild(ucwords($i), array('route' => $i))
                		->setAttribute('icon', 'icon-edit');
                }
            }else{
                $menu->addChild(ucwords($packages['manager']), array('route' => $packages['manager']));
            }
        }


    }
}

?>
