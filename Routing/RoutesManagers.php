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
        foreach($this->container->get('artesanus.managers')->getManagers() as $p => $packages){
            if(!is_int($p)){
                foreach($packages as $i => $item){

                    $p = strtolower($p);

                    $routes->add($i, new Route($p.'/'.$i, array(
                        '_controller' => 'ArtesanusBundle:Manager:list',
                    )));

                    $routes->add($i.'_new', new Route($p.'/'.$i.'/new', array(
                        '_controller' => 'ArtesanusBundle:Manager:new',
                    )));

                    $routes->add($i.'_edit', new Route($p.'/'.$i.'/{id}', array(
                        '_controller' => 'ArtesanusBundle:Manager:edit',
                    )));

                    $routes->add($i.'_delete', new Route($p.'/'.$i.'/delete', array(
                        '_controller' => 'ArtesanusBundle:Manager:delete',
                    )));
                }
            }else{
                $routes->add($packages['manager'], new Route($packages['manager'], array(
                    '_controller' => 'ArtesanusBundle:Manager:list',
                )));

                $routes->add($packages['manager'].'_new', new Route($packages['manager'].'/new', array(
                    '_controller' => 'ArtesanusBundle:Manager:new',
                )));

                $routes->add($packages['manager'].'_edit', new Route($packages['manager'].'/{id}', array(
                    '_controller' => 'ArtesanusBundle:Manager:edit',
                )));

                $routes->add($packages['manager'].'_delete', new Route($packages['manager'].'/delete', array(
                    '_controller' => 'ArtesanusBundle:Manager:delete',
                )));
            }
        }

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'extra' === $type;
    }
}
