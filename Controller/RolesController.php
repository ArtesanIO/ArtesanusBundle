<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RolesController extends Controller
{
    public function rolesAction()
    {
        $rolesManager = $this->get('artesanus.roles_manager');

        $roles = $rolesManager->getRepository()->findAll();

        return $this->render('ArtesanusBundle:ACL:roles.html.twig', array(
            'roles' => $roles
        ));
    }

    public function newAction(Request $request)
    {
        $rolesManager = $this->get('artesanus.roles_manager');

        $roles = $rolesManager->create();

        $rolesForm = $this->createForm('artesanus_acl_roles', $roles)->handleRequest($request);

        if($rolesForm->isValid()){

            $this->get('artesanus.roles_manager')->save($roles);

            return $this->redirect($this->generateUrl('artesanus_console_acl_role', array('id' => $roles->getId())));
        }

        return $this->render('ArtesanusBundle:ACL:role.html.twig', array(
            'roles_form' => $rolesForm->createView()
        ));
    }

    public function roleAction(Request $request, $id)
    {
        $rolesManager = $this->get('artesanus.roles_manager');

        $role = $rolesManager->getRepository()->findOneBy(array('id' => $id));

        $rolesForm = $this->createForm('artesanus_acl_roles', $role)->handleRequest($request);

        if($rolesForm->isValid()){

            $this->get('artesanus.roles_manager')->save($role);

            return $this->redirect($this->generateUrl('artesanus_console_acl_role', array('id' => $role->getId())));
        }

        return $this->render('ArtesanusBundle:ACL:role.html.twig', array(
            'role' => $role,
            'roles_form' => $rolesForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $rolesManager = $this->get('artesanus.roles_manager');

        $role = $rolesManager->getRepository()->findOneBy(array('id' => $id));

        $rolesManager->delete($role);

        return $this->redirect($this->generateUrl('artesanus_console_acl_roles'));
    }
}
