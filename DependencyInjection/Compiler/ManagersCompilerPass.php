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

    private function registerManagers($container, $entities)
    {
        foreach($entities as $entity){

            $container->setDefinition($this->entityPrefix($entity).'.manager', new Definition(
                $this->entityManager($entity), array($entity)
                ))->addMethodCall('setContainer', array(
                    new Reference('service_container')
                ))->addTag('artesanus.manager')
            ;

            // $container->setDefinition($this->entityPrefix($entity).'.type', new Definition(
            //     $this->entityType($entity)
            //     ))->addTag('form.type', array('alias' => $this->entityPrefix($entity).'_type'))
            // ;

            $container
                ->register(
                    $this->entityPrefix($entity).'.type',
                    $this->entityType($entity)
                )
                ->addTag('form.type', array(
                    'alias' => $this->entityPrefix($entity).'_type',
                ))
            ;
        }
    }

    private function entityPrefix($entity)
    {
        $prefix = explode('\\', $entity);

        return strtolower(end($prefix));
    }

    private function entityManager($entity)
    {
        $entityManager = str_replace('Entity', 'Model', $entity);

        return $entityManager.'Manager';
    }

    private function entityType($entity)
    {
        $entityManager = str_replace('Entity', 'Form', $entity);

        return $entityManager.'Type';
    }
}
