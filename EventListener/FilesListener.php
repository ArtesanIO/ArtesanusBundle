<?php

namespace ArtesanIO\ArtesanusBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Event\ModelEvent;

class FilesListener
{

    public function onBeforeFiles(ModelEvent $event)
    {
        $files = $event;
    }

}


?>
