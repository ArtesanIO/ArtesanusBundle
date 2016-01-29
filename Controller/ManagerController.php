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

        $routes = array('edit' => $manager->routeEdit(), 'delete' => $manager->routeDelete());

        $entity = $manager->create();

        $entities = $manager->getRepository()->findAll();

        $entityForm = $this->createForm($prefix.'_type', $entity)->handleRequest($request);

        if($entityForm->isValid()){
            $manager->save($entity);
            $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        return $this->render('ArtesanusBundle:Managers:list.html.twig',
            array('entities' => $entities,'fields' => $manager->tableFields(), 'routes' => $routes, 'entity_form' => $entityForm->createView())
        );
    }

    public function newAction()
    {
        exit('New');
    }

    public function editAction($id, Request $request)
    {
        $prefix = $request->get('_route');

        $prefix = explode('_', $prefix);
        $prefix = $prefix[0];
        $manager = $this->get($prefix.'.manager');
        $routes = array('edit' => $manager->routeEdit(), 'delete' => $manager->routeDelete());

        $entity = $manager->getRepository()->findOneBy(array('id' => $id));

        $entityForm = $this->createForm($prefix.'_type', $entity)->handleRequest($request);

        if($entityForm->isValid()){
            $manager->save($entity);
            $manager->redirectTo($request, array('id' => $entity->getId()));
        }

        return $this->render('ArtesanusBundle:Managers:edit.html.twig',
            array('entity' => $entity,'entity_form' => $entityForm->createView())
        );
    }

    public function deleteAction()
    {
        exit('remove');
    }
}
