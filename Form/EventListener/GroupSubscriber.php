<?php

namespace ArtesanIO\ArtesanusBundle\Form\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GroupSubscriber implements EventSubscriberInterface
{
    protected $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }

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

        $form
            ->add('name')
            ->add('roles','choice', array(
                'choices'   => $this->roles->roles(),
                'data'      => $data->getRoles(),
                'expanded'  => true,
                'multiple'  => true
            ))
        ;

    }
}

?>
