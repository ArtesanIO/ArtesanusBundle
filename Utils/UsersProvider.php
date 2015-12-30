<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

use ArtesanIO\ArtesanusBundle\Entity\Users;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UsersProvider implements UserProviderInterface
{

    private $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function loadUserByUsername($username)
    {
        // make a call to your webservice here
        //$userData = ...
        // pretend it returns an array on success, false if there is no user
        echo "<pre>";print_r($username);exit();
        if ($userData) {
            $password = '...';

            // ...

            return new Users($username, $password, $salt, $roles);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof Users) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'ArtesanusBundle\Entity\Users';
    }
}
