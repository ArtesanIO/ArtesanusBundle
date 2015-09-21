<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArtesanIO\ACLBundle\Form\GroupType;


class GroupController extends Controller
{
    public function groupsAction()
    {
        $grupos = $this->get('fos_user.group_manager')->findGroups();

        return $this->render('ArtesanusBundle:Grupos:grupos.html.twig', array(
            'grupos' => $grupos
        ));
    }

    public function newAction(Request $request)
    {

        $groupManager = $this->get('artesanus.group_manager');

        $group = $groupManager->getClass();

        $groupForm = $this->createForm('artesanus_group_type', $group)->handleRequest($request);

        if($groupForm->isValid()){

            $this->get('artesanus.group_manager')->save($group);

            $groupManager->addRoles($group, $groupForm);

            return $this->redirect($this->generateUrl('grupo', array('id' => $group->getId())));
        }

        return $this->render('ArtesanusBundle:Grupos:grupos-crear.html.twig', array(
            'grupo_form' => $groupForm->createView()
        ));
    }

    public function groupAction(Request $request, $id)
    {
        $groupManager = $this->get('artesanus.group_manager');

        $group = $groupManager->find($id);

        $roles = $this->get('artesanus.roles_manager')->getRoles();

        $groupForm = $this->createForm('artesanus_group_type', $group)->handleRequest($request);

        if($groupForm->isValid()){

            $groupManager->addRoles($group, $groupForm);

            return $this->redirect($this->generateUrl('grupo', array('id' => $group->getId())));

        }

        return $this->render('ArtesanusBundle:Grupos:grupo.html.twig', array(
            'grupo'            => $group,
            'grupo_form'       => $groupForm->createView(),
        ));
    }
}
