<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $security;

    function __construct(Router $router, SecurityContext $security)
    {
        $this->router   = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $this->security->getToken()->getUser();

        if($user->getGroups()->getName() === 'Admin'){
            return new RedirectResponse($this->router->generate('users'));
        }
    }
}


 ?>
