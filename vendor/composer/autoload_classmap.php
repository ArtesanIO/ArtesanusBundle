<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'ArtesanIO\\ArtesanusBundle\\ArtesanusBundle' => $baseDir . '/ArtesanusBundle.php',
    'ArtesanIO\\ArtesanusBundle\\ArtesanusEvents' => $baseDir . '/ArtesanusEvents.php',
    'ArtesanIO\\ArtesanusBundle\\Command\\UsersCreateCommand' => $baseDir . '/Command/UsersCreateCommand.php',
    'ArtesanIO\\ArtesanusBundle\\Controller\\GroupController' => $baseDir . '/Controller/GroupController.php',
    'ArtesanIO\\ArtesanusBundle\\Controller\\LoginController' => $baseDir . '/Controller/LoginController.php',
    'ArtesanIO\\ArtesanusBundle\\Controller\\ProfileController' => $baseDir . '/Controller/ProfileController.php',
    'ArtesanIO\\ArtesanusBundle\\Controller\\RolesController' => $baseDir . '/Controller/RolesController.php',
    'ArtesanIO\\ArtesanusBundle\\Controller\\StorageController' => $baseDir . '/Controller/StorageController.php',
    'ArtesanIO\\ArtesanusBundle\\Controller\\UserController' => $baseDir . '/Controller/UserController.php',
    'ArtesanIO\\ArtesanusBundle\\DataFixtures\\ORM\\Dev\\ArtesanusLoader' => $baseDir . '/DataFixtures/ORM/ArtesanusLoader.php',
    'ArtesanIO\\ArtesanusBundle\\DependencyInjection\\ArtesanusExtension' => $baseDir . '/DependencyInjection/ArtesanusExtension.php',
    'ArtesanIO\\ArtesanusBundle\\DependencyInjection\\Configuration' => $baseDir . '/DependencyInjection/Configuration.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\Categories' => $baseDir . '/Entity/Categories.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\CategoriesRepository' => $baseDir . '/Entity/CategoriesRepository.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\Files' => $baseDir . '/Entity/Files.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\FilesRepository' => $baseDir . '/Entity/FilesRepository.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\Groups' => $baseDir . '/Entity/Groups.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\GroupsRoles' => $baseDir . '/Entity/GroupsRoles.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\GroupsRolesRepository' => $baseDir . '/Entity/GroupsRolesRepository.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\Roles' => $baseDir . '/Entity/Roles.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\User' => $baseDir . '/Entity/User.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\UserRepository' => $baseDir . '/Entity/UserRepository.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\Users' => $baseDir . '/Entity/Users.php',
    'ArtesanIO\\ArtesanusBundle\\Entity\\UsersRepository' => $baseDir . '/Entity/UsersRepository.php',
    'ArtesanIO\\ArtesanusBundle\\EventListener\\ArtesanusMenuListener' => $baseDir . '/EventListener/ArtesanusMenuListener.php',
    'ArtesanIO\\ArtesanusBundle\\EventListener\\ArtesanusRolesListener' => $baseDir . '/EventListener/ArtesanusRolesListener.php',
    'ArtesanIO\\ArtesanusBundle\\EventListener\\FilesListener' => $baseDir . '/EventListener/FilesListener.php',
    'ArtesanIO\\ArtesanusBundle\\Event\\ArtesanusMenuEvent' => $baseDir . '/Event/ArtesanusMenuEvent.php',
    'ArtesanIO\\ArtesanusBundle\\Event\\ArtesanusRolesEvent' => $baseDir . '/Event/ArtesanusRolesEvent.php',
    'ArtesanIO\\ArtesanusBundle\\Event\\ModelEvent' => $baseDir . '/Event/ModelEvent.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\CategoriesType' => $baseDir . '/Form/CategoriesType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\EventListener\\GroupSubscriber' => $baseDir . '/Form/EventListener/GroupSubscriber.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\EventListener\\UsersSubscriber' => $baseDir . '/Form/EventListener/UsersSubscriber.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\FilesType' => $baseDir . '/Form/FilesType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\GroupsRolesType' => $baseDir . '/Form/GroupsRolesType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\GroupsType' => $baseDir . '/Form/GroupsType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\ProfileType' => $baseDir . '/Form/ProfileType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\RolesType' => $baseDir . '/Form/RolesType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\UsersPasswordType' => $baseDir . '/Form/UsersPasswordType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\UsersType' => $baseDir . '/Form/UsersType.php',
    'ArtesanIO\\ArtesanusBundle\\Form\\UsuariosType' => $baseDir . '/Form/UsuariosType.php',
    'ArtesanIO\\ArtesanusBundle\\Menu\\Builder' => $baseDir . '/Menu/Builder.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\CategoriesManager' => $baseDir . '/Model/CategoriesManager.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\FilesManager' => $baseDir . '/Model/FilesManager.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\GroupsManager' => $baseDir . '/Model/GroupsManager.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\ModelManager' => $baseDir . '/Model/ModelManager.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\ModelManagerInterface' => $baseDir . '/Model/ModelManagerInterface.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\RoleInterface' => $baseDir . '/Model/RoleInterface.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\Roles' => $baseDir . '/Model/Roles.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\RolesManager' => $baseDir . '/Model/RolesManager.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\UsersBase' => $baseDir . '/Model/UsersBase.php',
    'ArtesanIO\\ArtesanusBundle\\Model\\UsersManager' => $baseDir . '/Model/UsersManager.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\Cartero' => $baseDir . '/Utils/Cartero.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\Encoder' => $baseDir . '/Utils/Encoder.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\Flashers' => $baseDir . '/Utils/Flashers.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\FlashersExtension' => $baseDir . '/Utils/FlashersExtension.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\LoginSuccessHandler' => $baseDir . '/Utils/LoginSuccessHandler.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\LogoutSuccessHandler' => $baseDir . '/Utils/LogoutSuccessHandler.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\SlugerRole' => $baseDir . '/Utils/SlugerRole.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\Slugger' => $baseDir . '/Utils/Slugger.php',
    'ArtesanIO\\ArtesanusBundle\\Utils\\UsersProvider' => $baseDir . '/Utils/UsersProvider.php',
);
