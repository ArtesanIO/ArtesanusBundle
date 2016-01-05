<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ArtesanIO\ArtesanusBundle\Model\UsersBase;

/**
 * @ORM\Table(name="artesanus_users")
 * @ORM\Entity(repositoryClass="ArtesanIO\ArtesanusBundle\Entity\UsersRepository")
 */
class Users extends UsersBase
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Groups")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
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
     * Set name
     *
     * @param string $name
     * @return Users
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

    /**
     * Get groups
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    public function getRoles()
    {

        $roles = [];

        foreach($this->getGroups()->getRoles() as $role)
        {
            $roles[$role->getRoles()->getRoleKey()] = $role->getRoles()->getRoleKey();
        }

        return $roles;
    }
}
