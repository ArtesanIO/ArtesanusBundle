<?php

namespace ArtesanIO\ArtesanusBundle\Form\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UsersSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
          FormEvents::PRE_SET_DATA => 'preSetData',

        );
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        if(!$data->getId()){
            $form
            ->add('password','repeated', array(
                'type' => 'password',
                'invalid_message' => 'Los password no coinciden',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repita Password'),
            ));
        }
    }
}

?>
