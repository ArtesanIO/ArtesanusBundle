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

        $user->setUsername('admin');
        $user->setEmail('admin@cristian.com');

        $encoder = $this->get('artesanus.encoder');

        $user->setPassword($encoder->encoder($user, 'admin'));

        $groupsManager = $this->get('artesanus.groups_manager');

        $groups = $groupsManager->getRepository()->findOneBy(array('name' => 'Admin'));

        $user->setGroups($groups);
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
        $usersManager = $this->get('artesanus.users_manager');

        $user = $usersManager->create();

        $userForm = $this->createForm('artesanus_users_type', $user)->handleRequest($request);

        if ($userForm->isValid()) {

            $user->setPassword($this->get('artesanus.encoder')->encoder($user, $user->getPassword()));
            $usersManager->save($user);

            return $usersManager->redirectTo($request, array('id' => $user->getId()));
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
            return $this->redirect($this->generateUrl('artesanus_console_acl_user', array('id' => $user->getId())));
        }

        $userPasswordForm =  $this->createForm('artesanus_users_password_type', $user)->handleRequest($request);

        if($userPasswordForm->isValid()){

            $user->setPassword($this->get('artesanus.encoder')->encoder($user, $user->getPassword()));
            $usersManager->save($user);
            return $this->redirect($this->generateUrl('artesanus_console_acl_user', array('id' => $user->getId())));
        }

        return $this->render('ArtesanusBundle:ACL:user.html.twig', array(
            'user_form' => $userForm->createView(),
            'user_password_form' => $userPasswordForm->createView()
        ));
    }

    public function deleteAction($id)
    {
        $usersManager = $this->get('artesanus.users_manager');

        $user = $usersManager->getRepository()->findOneBy(array('id' => $id));

        $usersManager->delete($user);

        return $this->redirect($this->generateUrl('artesanus_console_acl_users'));
    }
}
