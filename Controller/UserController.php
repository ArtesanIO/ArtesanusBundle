<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function registerAction()
    {
        $usersManager = $this->get('artesanus.users_manager');
        $user = $usersManager->create();

        $user->setUsername('cristian');
        $user->setEmail('cristian@cristian.com');

        $encoder = $this->get('artesanus.encoder');

        $user->setPassword($encoder->encoder($user, 'cristian'));

        $usersManager->save($user);

        return new Response('Creado');
    }

    public function usersAction()
    {
        $userManager = $this->get('artesanus.users_manager');

        $users = $userManager->getRepository()->findAll();

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
        $usersManager = $this->get('artesanus.users_manager');

        $user = $usersManager->getRepository()->findOneBy(array('id' => $id));

        $userForm = $this->createForm('artesanus_users_type', $user)->handleRequest($request);

        if($userForm->isValid()){

            $usersManager->save($user);
            $this->get('artesanus.flashers')->add('info','Usuario actualizado');
            return $this->redirect($this->generateUrl('artesanus_console_acl_user', array('id' => $user->getId())));
        }

        // $formFactory = $this->get('fos_user.change_password.form.factory');
        //
        // $usuarioPasswordForm = $formFactory->createForm();
        // $usuarioPasswordForm->setData($user);
        //
        // $usuarioPasswordForm->handleRequest($request);
        //
        // if ($usuarioPasswordForm->isValid()) {
        //     $userManager->updateUser($user);
        //     $this->get('artesanus.flashers')->add('info','Contraseña actualizada');
        //     return $this->redirect($this->generateUrl('artesanus_console_acl_user', array('id' => $user->getUsername())));
        // }

        return $this->render('ArtesanusBundle:ACL:user.html.twig', array(
            'user_form' => $userForm->createView(),
            //'user_password_form' => $usuarioPasswordForm->createView()
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
