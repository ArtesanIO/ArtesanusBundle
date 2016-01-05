<?php

namespace ArtesanIO\ArtesanusBundle\Form;

use ArtesanIO\ArtesanusBundle\Form\EventListener\UsersSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\ArtesanusBundle\Form\EventListener\UserSubscriber;

class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('groups','entity', array(
                    'class' => 'ArtesanusBundle:Groups',
                    'property' => 'name',
                    'empty_value' => 'artesanus.form.empty_value',
                    'translation_domain' => 'ArtesanusBundle',
                ))
                ->add('name')
                ->add('email')
                ->add('username')
            ;

            $builder->addEventSubscriber(new UsersSubscriber());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\ArtesanusBundle\Entity\Users'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'artesanus_users_type';
    }
}
