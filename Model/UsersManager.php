<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use ArtesanIO\ArtesanusBundle\Model\ModelManager;

class UsersManager extends ModelManager
{
    public function tableFields()
    {
        return array('id','name');
    }


}
