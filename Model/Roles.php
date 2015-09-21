<?php

namespace ArtesanIO\ArtesanusBundle\Model;

class Roles
{
    protected $roles;

    public function __construct()
    {
        $this->roles = [];
    }

    public function createRole(array $array = array())
    {
        $array[1]["key"] = $array[0];

        if(!isset($array[1]["description"])){
            $array[1]["description"] = '--';
        }

        return $this->roles[$array[0]] = $array[1];
    }

    public function getRoles()
    {
        return $this->roles;
    }
}



?>
