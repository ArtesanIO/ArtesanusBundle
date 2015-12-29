<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use ArtesanIO\ArtesanusBundle\Model\ModelManager;
// use ArtesanIO\ArtesanusBundle\ArtesanusEvents;
// use ArtesanIO\ArtesanusBundle\Event\ArtesanusRolesEvent;
// use ArtesanIO\ArtesanusBundle\Model\Roles;
// use Symfony\Component\DependencyInjection\ContainerAware;

class RolesManager extends ModelManager
{

    // protected $roles;
    //
    // public function __construct(ROLES $roles)
    // {
    //     $this->roles = $roles;
    // }
    //
    // public function getRoles()
    // {
    //     $this->container->get('event_dispatcher')->dispatch(
    //         ArtesanusEvents::ARTESANUS_ROLES, new ArtesanusRolesEvent($this->roles)
    //     );
    //
    //     return $this->roles->getRoles();
    // }
    //
    // public function roles()
    // {
    //
    //     $roles = [];
    //
    //     foreach($this->getRoles() as $key => $role){
    //         $roles[$key] = $role["role"]." | ".$key;
    //     }
    //
    //     return $roles;
    // }
}
