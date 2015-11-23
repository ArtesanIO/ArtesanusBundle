<?php

namespace ArtesanIO\ArtesanusBundle\Menu;

use ArtesanIO\ArtesanusBundle\ArtesanusEvents;
use ArtesanIO\ArtesanusBundle\Event\ArtesanusMenuEvent;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function consoleMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array('childrenAttributes' => array('class' => 'nav navbar-nav')));

        $this->container->get('event_dispatcher')->dispatch(
            ArtesanusEvents::ARTESANUS_NAVBAR,
            new ArtesanusMenuEvent($factory, $menu)
        );

        return $menu;
    }
}


?>
