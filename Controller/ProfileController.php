<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ArtesanIO\ArtesanusBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    public function editAction(Request $request)
    {
        if(!$this->isGranted("IS_AUTHENTICATED_FULLY")){
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $userManager = $this->get('fos_user.user_manager');

        $user = $this->getUser();

        $form = $this->createForm('artesanus_profile_type', $user);

        $form->handleRequest($request);

        if($form->isValid()){
            $user->upload();
            $userManager->updateUser($user);
            return $this->redirect($this->generateUrl('fos_user_profile_edit'));
        }

        $formFactory = $this->get('fos_user.change_password.form.factory');

        $usuarioPasswordForm = $formFactory->createForm();
        $usuarioPasswordForm->setData($user);

        $usuarioPasswordForm->handleRequest($request);

        if ($usuarioPasswordForm->isValid()) {
            $userManager->updateUser($user);
            return $this->redirect($this->generateUrl('usuario', array('id' => $user->getUsername())));
        }

        return $this->render('ArtesanusBundle:Profile:profile.html.twig', array(
            'usuario_form' => $form->createView(),
            'usuario_password_form' => $usuarioPasswordForm->createView()
        ));

    }
}
