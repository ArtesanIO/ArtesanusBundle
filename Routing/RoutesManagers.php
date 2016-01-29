<?php

namespace ArtesanIO\ArtesanusBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RoutesManagers extends Loader
{
    private $loaded = false;

    protected $container;

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

            $routes->add($item['alias'], new Route($this->router($item), array(
                '_controller' => 'ArtesanusBundle:Manager:list',
            )));

            $routes->add($item['alias'].'_new', new Route($this->router($item).'/new', array(
                '_controller' => 'ArtesanusBundle:Manager:new',
            )));

            $routes->add($item['alias'].'_edit', new Route($this->router($item).'/{id}', array(
                '_controller' => 'ArtesanusBundle:Manager:edit',
            )));

            $routes->add($item['alias'].'_delete', new Route($this->router($item).'/delete', array(
                '_controller' => 'ArtesanusBundle:Manager:delete',
            )));
        }

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'extra' === $type;
    }

    private function router($item)
    {
        return $item['alias'];
    }
}
