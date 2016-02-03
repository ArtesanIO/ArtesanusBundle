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

        $this->registerManagers($container, $container->getParameter('artesanus.entities'));

        $taggedServices = $container->findTaggedServiceIds(
            'artesanus.manager'
        );

        $types = $container->findTaggedServiceIds(
            'form.type'
        );

        //echo "<pre>";print_r($types);exit();

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addManager',
                array(new Reference($id))
            );
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
