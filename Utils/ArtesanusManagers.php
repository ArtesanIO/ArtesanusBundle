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
        $this->managers[] = $this->entityPrefix(get_class($manager));
    }

    public function getManagers()
    {
        return $this->managers;
    }

    public function entityPrefix($manager)
    {
        $prefix = explode('\\', $manager);
        $prefix = end($prefix);
        $prefix = str_replace('Manager', '', $prefix);
        return strtolower($prefix);
    }
}
