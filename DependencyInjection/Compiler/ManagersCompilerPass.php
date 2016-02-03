<?php

namespace ArtesanIO\ArtesanusBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class ManagersCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('artesanus.managers')) {
            return;
        }

        $definition = $container->getDefinition(
            'artesanus.managers'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'artesanus.manager'
        );

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addManager',
                array(new Reference($id))
            );
        }
    }
}
