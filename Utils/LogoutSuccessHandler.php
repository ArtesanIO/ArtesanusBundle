<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;


class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    protected $router;

    function __construct(Router $router)
    {
        $this->router   = $router;
    }

    public function onLogoutSuccess(Request $request)
    {
        return new RedirectResponse($request->headers->get('referer'));;
    }
}


 ?>
