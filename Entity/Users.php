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
}
