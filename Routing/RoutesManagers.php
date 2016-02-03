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

        foreach($this->container->getParameter('artesanus.entities') as $item){

            $routes->add($this->entityPrefix($item), new Route($this->entityPrefix($item), array(
                '_controller' => 'ArtesanusBundle:Manager:list',
            )));

            $routes->add($this->entityPrefix($item).'_new', new Route($this->entityPrefix($item).'/new', array(
                '_controller' => 'ArtesanusBundle:Manager:new',
            )));

            $routes->add($this->entityPrefix($item).'_edit', new Route($this->entityPrefix($item).'/{id}', array(
                '_controller' => 'ArtesanusBundle:Manager:edit',
            )));

            $routes->add($this->entityPrefix($item).'_delete', new Route($this->entityPrefix($item).'/delete', array(
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

    private function entityPrefix($entity)
    {
        $prefix = explode('\\', $entity);

        return strtolower(end($prefix));
    }
}
