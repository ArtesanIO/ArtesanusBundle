<?php

namespace ArtesanIO\ArtesanusBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ArtesanusExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        if(isset($config["entities"])){
            $container->setParameter('artesanus.entities', $config['entities']);
        }

        // if(isset($config["cartero"])){
        //     $container->setParameter('artesanus.cartero.subject', $config['cartero']['subject']);
        //     $container->setParameter('artesanus.cartero.from.email', $config['cartero']['from']['email']);
        //     $container->setParameter('artesanus.cartero.from.host', $config['cartero']['from']['host']);
        // }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('managers.yml');
        $loader->load('parameters.yml');
        $loader->load('services.yml');
        $loader->load('types.yml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $knpMenuConfig['twig']              = true; // set to false to disable the Twig extension and the TwigRenderer
        $knpMenuConfig['templating']        = false; // if true, enables the helper for PHP templates
        $knpMenuConfig['default_renderer']  = 'twig'; // The renderer to use, list is also available by default
        $container->prependExtensionConfig('knp_menu', $knpMenuConfig);

        $fosUserConfig['db_driver']                     = 'orm'; // other valid values are 'mongodb', 'couchdb'
        $fosUserConfig['firewall_name']                 = 'main';
        $fosUserConfig['user_class']                    = 'ArtesanIO\ArtesanusBundle\Entity\User';
        $fosUserConfig['group']['group_class']          = 'ArtesanIO\ArtesanusBundle\Entity\Group';
        $fosUserConfig['resetting']['token_ttl']        = 86400;

        $container->prependExtensionConfig('fos_user', $fosUserConfig);

        $configs = $container->getExtensionConfig($this->getAlias());
        $this->processConfiguration(new Configuration(), $configs);
    }
}
