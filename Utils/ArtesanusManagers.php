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

    public function addManager($manager, $package, $inConsole)
    {
        $this->managers[$this->entityPrefix(get_class($manager))]['manager'] = $this->entityPrefix(get_class($manager));
        $this->managers[$this->entityPrefix(get_class($manager))]['package'] = $package;
        $this->managers[$this->entityPrefix(get_class($manager))]['in_console'] = $inConsole;
    }

    public function getManagers()
    {
        $packages = array();

        foreach($this->managers as $manager){
            ($manager['package'] != '') ? $packages[$manager['package']][$manager['manager']] = $manager['manager']: $packages[] = $manager;;
        }

        return $packages;
    }

    public function entityPrefix($manager)
    {
        $prefix = explode('\\', $manager);
        $prefix = end($prefix);
        $prefix = str_replace('Manager', '', $prefix);
        return strtolower($prefix);
    }
}
