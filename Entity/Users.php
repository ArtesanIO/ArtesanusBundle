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
     * @ORM\ManyToMany(targetEntity="ArtesanIO\ArtesanusBundle\Entity\Groups")
     * @ORM\JoinTable(name="artesanus_users_groups",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    public function __construct()
    {
        parent::__construct();
    }
}
