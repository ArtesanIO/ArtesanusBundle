<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function usersAction()
    {
        $cartero = $this->get('artesanus.cartero');

        $cartero->msn('cristianangulonova@hotmail.com','enviando un mensaje desde cartero');
        
        $userManager = $this->get('fos_user.user_manager');

        $users = $userManager->findUsers();

        return $this->render('ArtesanusBundle:ACL:users.html.twig', array(
            'users' => $users
        ));
    }

    public function newAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $userForm = $this->createForm('artesanus_user_type', $user);

        $userForm->handleRequest($request);

        if ($userForm->isValid()) {
            $userManager->updateUser($user);
            $this->get('artesanus.flashers')->add('info','Usuario creado');
            return $this->redirect($this->generateUrl('artesanus_console_acl_user', array('id' => $user->getUsername())));
        }

        return $this->render('ArtesanusBundle:ACL:users-new.html.twig', array(
            'user_form' => $userForm->createView()
        ));
    }

    public function userAction(Request $request, $id)
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByUsername($id);

        $form = $this->createForm('artesanus_user_type', $user);

        $form->handleRequest($request);

        if($form->isValid()){

            $userManager->updateUser($user);
            $this->get('artesanus.flashers')->add('info','Usuario actualizado');
            return $this->redirect($this->generateUrl('artesanus_console_acl_user', array('id' => $user->getUsername())));
        }

        $formFactory = $this->get('fos_user.change_password.form.factory');

        $usuarioPasswordForm = $formFactory->createForm();
        $usuarioPasswordForm->setData($user);

        $usuarioPasswordForm->handleRequest($request);

        if ($usuarioPasswordForm->isValid()) {
            $userManager->updateUser($user);
            $this->get('artesanus.flashers')->add('info','Contraseña actualizada');
            return $this->redirect($this->generateUrl('artesanus_console_acl_user', array('id' => $user->getUsername())));
        }

        return $this->render('ArtesanusBundle:ACL:user.html.twig', array(
            'user_form' => $form->createView(),
            'user_password_form' => $usuarioPasswordForm->createView()
        ));
    }

    public function deleteAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserBy(array('id' => $id));

        $userManager->deleteUser($user);

        $this->get('artesanus.flashers')->add('warning','Usuario eliminado');
        return $this->redirect($this->generateUrl('artesanus_console_acl_users'));
    }
}
