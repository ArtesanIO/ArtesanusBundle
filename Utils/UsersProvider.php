<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

use ArtesanIO\ArtesanusBundle\Model\UsersBase;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UsersProvider implements UserProviderInterface
{

    private $usersManager;

    public function __construct($usersManager)
    {
        $this->usersManager = $usersManager;
    }

    public function loadUserByUsername($user)
    {

        $user = $this->usersManager->getRepository()->findUsernameOrEmail($user);

        if(!$user){
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $user));
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof UsersBase) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'ArtesanIO\ArtesanusBundle\Entity\Users';
    }
}
