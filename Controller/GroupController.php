<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GroupController extends Controller
{
    public function groupsAction()
    {
        $groupsManager = $this->get('artesanus.groups_manager');

        $groups = $groupsManager->getRepository()->findAll();

        return $this->render('ArtesanusBundle:ACL:groups.html.twig', array(
            'groups' => $groups
        ));
    }

    public function newAction(Request $request)
    {
        $groupsManager = $this->get('artesanus.groups_manager');

        $group = $groupsManager->create();

        $groupForm = $this->createForm('artesanus_groups_type', $group)->handleRequest($request);

        if($groupForm->isValid()){

            $groupsManager->save($group);

            $this->get('artesanus.flashers')->add('info',$this->get('translator')->trans('artesanus.msn_flash.created', array(), 'ArtesanusBundle'));

            return $this->redirect($this->generateUrl('artesanus_console_acl_group', array('id' => $group->getId())));
        }

        return $this->render('ArtesanusBundle:ACL:group.html.twig', array(
            'group_form' => $groupForm->createView()
        ));
    }

    public function groupAction(Request $request, $id)
    {
        $groupsManager = $this->get('artesanus.groups_manager');

        $group = $groupsManager->getRepository()->findOneBy(array('id' => $id));

        $rolesOriginals = $groupsManager->rolesOriginals($group);

        $groupForm = $this->createForm('artesanus_groups_type', $group)->handleRequest($request);

        if($groupForm->isValid()){

            $groupsManager->rolesUpdate($group, $rolesOriginals);

            $groupsManager->save($group);

            $this->get('artesanus.flashers')->add('info',$this->get('translator')->trans('artesanus.msn_flash.updated', array(), 'ArtesanusBundle'));

            return $this->redirect($this->generateUrl('artesanus_console_acl_group', array('id' => $group->getId())));

        }

        return $this->render('ArtesanusBundle:ACL:group.html.twig', array(
            'group'            => $group,
            'group_form'       => $groupForm->createView(),
        ));
    }

    public function gruposAction()
    {

        $filesManager = $this->get('artesanus.files_manager');

        $file = $filesManager->create();

        $filesManager->save($file);

        return $this->render('ArtesanusBundle:ACL:grupos.html.twig');

    }
}
