<?php

namespace ArtesanIO\ArtesanusBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArtesanusBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
