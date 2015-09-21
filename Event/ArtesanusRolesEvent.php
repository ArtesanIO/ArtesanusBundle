<?php

namespace ArtesanIO\ArtesanusBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ArtesanusRolesEvent extends Event
{
    private $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return Roles
     */

    public function getRoles()
    {
        return $this->roles;
    }
}

?>
