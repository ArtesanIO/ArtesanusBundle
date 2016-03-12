<?php

namespace ArtesanIO\ArtesanusBundle\Menu;

use ArtesanIO\ArtesanusBundle\ArtesanusEvents;
use ArtesanIO\ArtesanusBundle\Event\ArtesanusMenuEvent;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class ConsoleBuilder extends ContainerAware
{
    public function consoleMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array('childrenAttributes' => array('class' => 'nav navbar-nav')));

        $this->container->get('event_dispatcher')->dispatch(
            ArtesanusEvents::ARTESANUS_NAVBAR,
            new ArtesanusMenuEvent($factory, $menu)
        );

        return $menu;
    }

    public function mainMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav navbar-nav');

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');

        $username = $this->container->get('security.context')->getToken()->getUser()->getUsername();

		$menu->addChild('User', array('label' => $username))
			->setAttribute('dropdown', true)
			->setAttribute('icon', 'icon-user')
            ->setAttribute('class', 'dropdown-toggle');

		$menu['User']->addChild('Profile', array('route' => 'users'))
			->setAttribute('icon', 'icon-edit');

            $menu['User']->addChild('Logout', array('route' => 'fos_user_security_logout'))
    			->setAttribute('icon', 'icon-edit');

        return $menu;
    }

    public function subMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'btn-group');

        $request = $this->container->get('request');
        $routeName = $this->container->get('artesanus.entity_prefix')->getEntityPrefix($request->get('_route'));

        $managers = $this->container->get('artesanus.managers');

        $package = '';

        foreach($managers->getManagers() as $manager){
            foreach($manager as $m){
                if($routeName === $m){
                    $package = $manager;
                }
            }
        }

        foreach($package as $p){
            $menu->addChild(ucwords($p), array('route' => $p))
    			->setAttribute('icon', 'icon-list');
        }

        return $menu;
    }

    public function aclMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        return $menu;
    }

    public function usersNewMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'menu-plus');

		$menu->addChild('+', array('route' => 'artesanus_console_acl_users_new'))
			->setAttribute('icon', 'icon-list');
        return $menu;
    }

    public function groupsNewMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'menu-plus');

		$menu->addChild('+', array('route' => 'artesanus_console_acl_groups_new'))
			->setAttribute('icon', 'icon-list');
        return $menu;
    }

    public function rolesNewMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'menu-plus');

		$menu->addChild('+', array('route' => 'artesanus_console_acl_roles_new'))
			->setAttribute('icon', 'icon-list');
        return $menu;
    }
}
