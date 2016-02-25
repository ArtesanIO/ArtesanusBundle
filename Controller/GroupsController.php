<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ArtesanIO\ArtesanusBundle\Controller\ManagerController;

class GroupsController extends ManagerController
{
    public function editAction($id, Request $request)
    {
        $prefix = $this->entityPrefix($request->get('_route'));
        $manager = $this->get($prefix.'.manager');

        $newEntity = $manager->create();

        $newEntityForm = $this->createForm($prefix.'_type', $newEntity, array('action' => $prefix.'_new'))->handleRequest($request);

        $entity = $manager->getRepository()->findOneBy(array('id' => $id));

        $rolesOriginals = $manager->rolesOriginals($entity);

        $entityForm = $this->createForm($prefix.'_type', $entity)->handleRequest($request);

        if($entityForm->isValid()){

             $manager->rolesUpdate($entity, $rolesOriginals);

            $manager->save($entity);
            return $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        return $this->render('ArtesanusBundle:ACL:group.html.twig', array(
            'entity' => $entity,
            'entity_form' => $entityForm->createView(),
            'new_entity_form' => $newEntityForm->createView()
            )
        );
    }
}
