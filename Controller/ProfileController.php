<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProfileController extends Controller
{
    public function profileAction(Request $request)
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
            return $this->redirect($this->generateUrl('artesanus_front_user_profile'));
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
            'user_form' => $form->createView(),
            'user_password_form' => $usuarioPasswordForm->createView()
        ));
    }

    public function coursesAction()
    {
        if(!$this->isGranted("IS_AUTHENTICATED_FULLY")){
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $coursesManager = $this->get('moocsy.courses_manager');
        $courses = $coursesManager->findCoursesUser();

        return $this->render('MoocsyBundle:Profile:courses.html.twig', array(
            'courses' => $courses
        ));
    }

    public function notificationsAction(Request $request)
    {
        if(!$this->isGranted("IS_AUTHENTICATED_FULLY")){
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $notificationsManager = $this->get('moocsy.notifications_manager');

        $notifications = $notificationsManager->create();

        $notificationsForm = $this->createForm('moocsy_notifications_type', $notifications)->handleRequest($request);

        if($notificationsForm->isValid()){

            $notifications->setRequestResponse(1);

            $notificationsManager->save($notifications);

            $this->get('artesanus.flashers')->add('info','Mensaje creado');

            return $this->redirect($this->generateUrl('moocsy_front_notifications'));
        }

        $userNotifications = $notificationsManager->findUserNotifications($this->getUser()->getId());

        return $this->render('MoocsyBundle:Profile:notifications.html.twig', array(
            'notifications_form' => $notificationsForm->createView(),
            'user_notifications' => $userNotifications
        ));
    }
}
