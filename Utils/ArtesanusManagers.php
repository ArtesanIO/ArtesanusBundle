<?php

namespace ArtesanIO\ArtesanusBundle\Utils;
use Symfony\Component\DependencyInjection\ContainerAware;

class ArtesanusManagers extends ContainerAware
{
    private $manager;

    public function __construct()
    {
        $this->managers = array();
    }

    public function addManager($manager)
    {
        $this->managers[] = $manager;
    }

    public function getManagers()
    {
        return $this->managers;
    }

    private function entityName($entity)
    {
    }
}
