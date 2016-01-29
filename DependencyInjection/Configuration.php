<?php

namespace ArtesanIO\ArtesanusBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('artesanus');

        $rootNode
            ->children()
                ->arrayNode('managers')
                    ->normalizeKeys(false)
                    ->defaultValue(array())
                    ->info('The list of entities to manage in the administration zone.')
                    ->prototype('variable')
                ->end()
                // ->arrayNode('cartero')
                //     ->children()
                //         ->scalarNode('subject')->end()
                //         ->arrayNode('from')
                //             ->children()
                //                 ->scalarNode('email')->end()
                //                 ->scalarNode('host')->end()
                //             ->end()
                //         ->end()
                //     ->end()
                // ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
