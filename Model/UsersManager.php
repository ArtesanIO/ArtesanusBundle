<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use ArtesanIO\ArtesanusBundle\Model\ModelManager;

class UsersManager extends ModelManager
{

    private $encoder;

    public function tableFields()
    {
        return array('id','name');
    }

    public function setEncoder($encoder)
    {
        $this->encoder = $encoder;
    }

    public function getEncoder()
    {
        return $this->encoder;
    }


}
