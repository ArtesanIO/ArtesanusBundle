<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

class EntityPrefix
{
    public function getEntityPrefix($route)
    {
        $prefix = explode('_', $route);
        return $prefix[0];
    }
}
