<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;


/**
 * @ORM\Table(name="artesanus_users")
 * @ORM\Entity(repositoryClass="ArtesanIO\ArtesanusBundle\Entity\UsersRepository")
 */
class Users extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\Groups",  inversedBy="users")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $groups;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set groups
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\Groups $groups
     * @return Users
     */
    public function setGroups(\ArtesanIO\ArtesanusBundle\Entity\Groups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    public function getRoles()
    {
        $roles = $this->roles;

        $groupsRoles = array();

        foreach($this->groups->getRoles() as $role){

            if($role->getEnabled() == 1){
                $groupsRoles[] = $role->getRoles()->getRole();
            }
        }

        $roles = array_merge($roles, $groupsRoles);

        return array_unique($roles);
    }
}
