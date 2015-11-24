<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GroupController extends Controller
{
    public function groupsAction()
    {
        $grupos = $this->get('fos_user.group_manager')->findGroups();

        return $this->render('ArtesanusBundle:ACL:groups.html.twig', array(
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
            $this->get('artesanus.flashers')->add('info','Grupo creado');

            return $this->redirect($this->generateUrl('artesanus_console_acl_group', array('id' => $group->getId())));
        }

        return $this->render('ArtesanusBundle:ACL:groups-new.html.twig', array(
            'group_form' => $groupForm->createView()
        ));
    }

    public function groupAction(Request $request, $id)
    {
        $groupManager = $this->get('artesanus.group_manager');

        $group = $groupManager->find($id);

        $groupForm = $this->createForm('artesanus_group_type', $group)->handleRequest($request);

        if($groupForm->isValid()){

            $groupManager->addRoles($group, $groupForm);
            $this->get('artesanus.flashers')->add('info','Grupo actualizado');

            return $this->redirect($this->generateUrl('artesanus_console_acl_group', array('id' => $group->getId())));

        }

        return $this->render('ArtesanusBundle:ACL:group.html.twig', array(
            'group'            => $group,
            'group_form'       => $groupForm->createView(),
        ));
    }
}
