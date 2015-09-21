<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

use ArtesanIO\ArtesanusBundle\Model\RolesManager;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $roles;
    protected $router;
    protected $security;

    function __construct(RolesManager $roles, Router $router, SecurityContext $security)
    {
        $this->roles    = $roles;
        $this->router   = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        foreach($this->roles->getRoles() as $role){
            if ($this->security->isGranted($role['key'])) {
                $response = new RedirectResponse($this->router->generate($role['login_route_success']));
            }
        }

        return $response;
    }
}


 ?>
