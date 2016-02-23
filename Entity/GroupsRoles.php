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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\Groups", inversedBy="roles")
    * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
    */
    private $groups;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\Roles", inversedBy="groups")
    * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
    */
    private $roles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;


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
     * Set enabled
     *
     * @param boolean $enabled
     * @return GroupsRoles
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set groups
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\Groups $groups
     * @return GroupsRoles
     */
    public function setGroups(\ArtesanIO\ArtesanusBundle\Entity\Groups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\Groups 
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set roles
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\Roles $roles
     * @return GroupsRoles
     */
    public function setRoles(\ArtesanIO\ArtesanusBundle\Entity\Roles $roles = null)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\Roles 
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
