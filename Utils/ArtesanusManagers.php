<?php

namespace ArtesanIO\ArtesanusBundle\Utils;
use Symfony\Component\DependencyInjection\ContainerAware;

class ArtesanusManagers extends ContainerAware
{
    public function getManagers()
    {
        $managers = array();

        foreach ($this->container->getParameter('artesanus.managers') as $entity) {

            if(is_array($entity)){
                foreach($entity as $k => $item){
                    $managers[$k]['name'] = $this->entityName($k);
                    $managers[$k]['alias'] = strtolower($managers[$k]['name']);
                    $managers[$k]['package'] = $item['package'];
                }
            }else{
                $managers[$entity]['name'] = $this->entityName($entity);
                $managers[$entity]['alias'] = strtolower($managers[$entity]['name']);
            }
        }

        return $managers;
    }

    private function entityName($entity)
    {
        $name = explode('\\', $entity);

        return end($name);
    }
}
