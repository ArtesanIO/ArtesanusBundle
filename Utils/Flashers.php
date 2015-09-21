<?php

namespace ArtesanIO\ArtesanusBundle\Utils;
use Symfony\Component\HttpFoundation\Session\Session;

class Flashers
{

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function add($type, $msn)
    {
        return $this->session->getFlashBag()->add($type, $msn);
    }

}



?>
