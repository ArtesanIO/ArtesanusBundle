<?php

namespace ArtesanIO\ArtesanusBundle\Model;

/**
 * Interface implemented by the factory to create roles
 */

interface RoleInterface
{
    /**
     * Creates a Role
     *
     * @param array $roles
     *
     * @return RolesHandlerInterface
     */
    public function createRole(array $roles = array());

}



?>
