<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class GroupsManager extends ModelManager
{
    public function tableFields()
    {
        return array('id','name',null);
    }
}
