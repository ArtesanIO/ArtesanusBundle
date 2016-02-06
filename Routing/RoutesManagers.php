<?php

namespace ArtesanIO\ArtesanusBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RoutesManagers extends Loader
{
    private $loaded = false;
    private $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }

        $routes = new RouteCollection();
        
        foreach($this->container->get('artesanus.managers')->getManagers() as $item){

            $routes->add($item, new Route($item, array(
                '_controller' => 'ArtesanusBundle:Manager:list',
            )));

            $routes->add($item.'_new', new Route($item.'/new', array(
                '_controller' => 'ArtesanusBundle:Manager:new',
            )));

            $routes->add($item.'_edit', new Route($item.'/{id}', array(
                '_controller' => 'ArtesanusBundle:Manager:edit',
            )));

            $routes->add($item.'_delete', new Route($item.'/delete', array(
                '_controller' => 'ArtesanusBundle:Manager:delete',
            )));
        }

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'extra' === $type;
    }
}
