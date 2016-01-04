<?php

namespace ArtesanIO\ArtesanusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\ArtesanusBundle\Form\EventListener\UserSubscriber;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

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
                    'property' => 'group',
                    'empty_value' => 'artesanus.form.empty_value',
                    'translation_domain' => 'ArtesanusBundle',
                ))
                ->add('name')
                ->add('email')
                ->add('username')
                // ->add('enabled')
                // ->add('groups', 'entity', array(
                //     'class' => 'ArtesanusBundle:Group',
                //     'property' => 'name',
                //     'expanded' => true,
                //     'multiple' => true,
                //     'required' => true,
                //     'empty_value' => '--Seleccione un Grupo--',
                // ))

                // ->addEventSubscriber(new UserSubscriber($this->security))
                // ->add('current_password', 'password', array(
                //     'label' => 'form.current_password',
                //     'translation_domain' => 'FOSUserBundle',
                //     'mapped' => false,
                //     'constraints' => new UserPassword(),
                // ))
            ;

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
