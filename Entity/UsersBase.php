<?php

namespace ArtesanIO\ArtesanusBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

abstract class UsersBase implements UserInterface, \Serializable, EquatableInterface
{
    private $username;
    private $password;
    private $salt;
    private $roles;

    // public function __construct($username, $password, $salt, array $roles)
    // {
    //     $this->username = $username;
    //     $this->password = $password;
    //     $this->salt = $salt;
    //     $this->roles = $roles;
    // }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
                return false;
        }

        if ($this->password !== $user->getPassword()) {
                return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
                return false;
        }

        if ($this->username !== $user->getUsername()) {
                return false;
        }

            return true;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}
