<?php

namespace ArtesanIO\ArtesanusBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
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
            foreach($tags as $attributes){
                $package = (isset($attributes['package'])) ? $attributes['package']: '';
                $in_console = (isset($attributes['in_console'])) ? $attributes['in_console']: '';
                $definition->addMethodCall(
                    'addManager',
                    array(new Reference($id), $package, $in_console)
                );
            }

        }
    }
}
