<?php

namespace ArtesanIO\ArtesanusBundle;

use ArtesanIO\ArtesanusBundle\DependencyInjection\Compiler\ManagersCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArtesanusBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ManagersCompilerPass());
    }
}
