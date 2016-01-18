<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class GroupsManager extends ModelManager
{
    public function rolesOriginals($model)
    {
        $collections = new ArrayCollection();

        foreach($model->getRoles() as $item){
            $collections->add($item);
        }

        return $collections;
    }

    public function rolesUpdate($model, $original)
    {
        foreach($original as $i){
            if(false === $model->getRoles()->contains($i)){
                $this->em()->remove($i);
            }
        }
    }

}
