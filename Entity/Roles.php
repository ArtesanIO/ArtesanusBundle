<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="artesanus_roles")
 * @ORM\Entity(repositoryClass="ArtesanIO\ArtesanusBundle\Entity\RolesRepository")
 */
class Roles
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
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\ArtesanusBundle\Entity\GroupsRoles", mappedBy="roles")
     */

    private $groups;

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
     * Set role
     *
     * @param string $role
     * @return Roles
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add groups
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $groups
     * @return Roles
     */
    public function addGroup(\ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $groups
     */
    public function removeGroup(\ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
