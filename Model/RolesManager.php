<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use ArtesanIO\ArtesanusBundle\Model\ModelManager;

class RolesManager extends ModelManager
{
    public function tableFields()
    {
        return array('id','role',null);
    }
}
