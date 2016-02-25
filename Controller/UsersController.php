<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use ArtesanIO\ArtesanusBundle\Controller\ManagerController;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends ManagerController
{
    public function editAction($id, Request $request)
    {
        $prefix = $this->entityPrefix($request->get('_route'));
        $manager = $this->get($prefix.'.manager');

        $entity = $manager->getRepository()->findOneBy(array('id' => $id));

        $entityForm = $this->createForm($prefix.'_type', $entity)->handleRequest($request);

        if($entityForm->isValid()){
            $manager->save($entity);
            return $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        $entityChangePasswordForm = $this->createForm('users_password_type')->handleRequest($request);

        if($entityChangePasswordForm->isValid()){
            $manager->save($entity);
            return $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        $newEntity = $manager->create();

        $newEntityForm = $this->createForm($prefix.'_type', $newEntity, array('action' => $prefix.'_new'))->handleRequest($request);

        return $this->render('ArtesanusBundle:ACL:user.html.twig', array(
            'entity' => $entity,
            'entity_form' => $entityForm->createView(),
            'entity_change_password_form' => $entityChangePasswordForm->createView(),
            'new_entity_form' => $newEntityForm->createView()
            )
        );
    }
}
