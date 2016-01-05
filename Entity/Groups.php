<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artesanus_groups")
 */
class Groups
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="GroupsRoles", mappedBy="groups", cascade={"persist", "remove"})
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
     * Set name
     *
     * @param string $name
     * @return Groups
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roles
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $roles
     * @return Groups
     */
    public function addRole(\ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $roles)
    {
        $this->roles->add($roles);
        $roles->setGroups($this);
    }

    /**
     * Remove roles
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $roles
     */
    public function removeRole(\ArtesanIO\ArtesanusBundle\Entity\GroupsRoles $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
