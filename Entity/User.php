<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\GroupInterface;

/**
 * @ORM\Entity(repositoryClass="ArtesanIO\ArtesanusBundle\Entity\UserRepository")
 * @ORM\Table(name="artesanus_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
