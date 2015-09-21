<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function usersAction()
    {


        $users = $this->get('artesanus.user_manager')->findAll();

        return $this->render('ArtesanusBundle:Usuarios:usuarios.html.twig', array(
            'usuarios' => $users
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

            return $this->redirect($this->generateUrl('usuario', array('id' => $user->getUsername())));
        }

        return $this->render('ArtesanusBundle:Usuarios:usuarios-crear.html.twig', array(
            'usuario_form' => $userForm->createView()
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

            return $this->redirect($this->generateUrl('usuario', array('id' => $user->getUsername())));
        }

        $formFactory = $this->get('fos_user.change_password.form.factory');

        $usuarioPasswordForm = $formFactory->createForm();
        $usuarioPasswordForm->setData($user);

        $usuarioPasswordForm->handleRequest($request);

        if ($usuarioPasswordForm->isValid()) {
            $userManager->updateUser($user);
            return $this->redirect($this->generateUrl('usuario', array('id' => $user->getUsername())));
        }

        return $this->render('ArtesanusBundle:Usuarios:usuario.html.twig', array(
            'usuario_form' => $form->createView(),
            'usuario_password_form' => $usuarioPasswordForm->createView()
        ));
    }
}
