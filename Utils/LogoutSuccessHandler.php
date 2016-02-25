<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        return new RedirectResponse($this->router->generate('fos_user_security_login'));
    }
}


 ?>
