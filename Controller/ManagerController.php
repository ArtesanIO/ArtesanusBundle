<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManagerController extends Controller
{
    public function listAction(Request $request)
    {

        $prefix = $request->get('_route');

        $manager = $this->get($prefix.'.manager');

        $entity = $manager->create();

        $entities = $manager->getRepository()->findAll();

        $newEntityForm = $this->createForm($prefix.'_type', $entity, array('action' => $prefix.'_new'))->handleRequest($request);

        if($newEntityForm->isValid()){
            $manager->save($entity);
            return $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        return $this->render('ArtesanusBundle:Managers:list.html.twig', array(
            'entityPrefix' => $manager->entityPrefix(),
            'entities' => $entities,
            'fields' => $manager->tableFields(),
            'new_entity_form' => $newEntityForm->createView()
            )
        );
    }

    public function newAction(Request $request)
    {
        $prefix = $request->get('_route');

        $prefix = $this->entityPrefix($prefix);

        $manager = $this->get($prefix.'.manager');

        $entity = $manager->create();

        $entities = $manager->getRepository()->findAll();

        $newEntityForm = $this->createForm($prefix.'_type', $entity, array('action' => $prefix.'_new'))->handleRequest($request);

        if($newEntityForm->isValid()){
            $manager->save($entity);
            return $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        exit('Problemas');
    }

    public function editAction($id, Request $request)
    {
        $prefix = $this->entityPrefix($request->get('_route'));
        $manager = $this->get($prefix.'.manager');

        $newEntity = $manager->create();

        $newEntityForm = $this->createForm($prefix.'_type', $newEntity, array('action' => $prefix.'_new'))->handleRequest($request);

        $entity = $manager->getRepository()->findOneBy(array('id' => $id));

        $entityForm = $this->createForm($prefix.'_type', $entity)->handleRequest($request);

        if($entityForm->isValid()){
            $manager->save($entity);
            return $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        return $this->render('ArtesanusBundle:Managers:edit.html.twig', array(
            'entity' => $entity,
            'entity_form' => $entityForm->createView(),
            'new_entity_form' => $newEntityForm->createView()
            )
        );
    }

    public function deleteAction($id, Request $request)
    {
        $prefix = $this->entityPrefix($request->get('_route'));
        $manager = $this->get($prefix.'.manager');

        $entity = $manager->getRepository()->findOneBy(array('id' => $id));

        if(!$entity){
            return $this->redirectToRoute($prefix);
        }

        $manager->delete($entity);

        return $this->redirectToRoute($prefix);
    }

    protected function entityPrefix($route)
    {
        return $this->get('artesanus.entity_prefix')->getEntityPrefix($route);
    }
}
