<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table(name="artesanus_groups")
 * @ORM\Entity(repositoryClass="ArtesanIO\ArtesanusBundle\Entity\GroupsRepository")
 */
class Groups
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\ArtesanusBundle\Entity\GroupsRoles", mappedBy="groups", cascade={"persist", "remove"})
     */

    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\ArtesanusBundle\Entity\Users", mappedBy="groups")
     */

    private $users;

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
     * Set roles
     *
     * @param string $roles
     * @return Groups
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
     * Add users
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\Users $users
     * @return Groups
     */
    public function addUser(\ArtesanIO\ArtesanusBundle\Entity\Users $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\Users $users
     */
    public function removeUser(\ArtesanIO\ArtesanusBundle\Entity\Users $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
