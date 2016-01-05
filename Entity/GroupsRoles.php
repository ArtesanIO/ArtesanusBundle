<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupsRoles
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ArtesanIO\ArtesanusBundle\Entity\GroupsRolesRepository")
 */
class GroupsRoles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Groups", inversedBy="roles")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    private $groups;

    /**
     * @ORM\ManyToOne(targetEntity="Roles", inversedBy="groups")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $roles;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set groups
     *
     * @param string $groups
     * @return GroupsRoles
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return string
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return GroupsRoles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
