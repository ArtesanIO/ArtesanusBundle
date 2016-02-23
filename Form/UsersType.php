<?php

namespace ArtesanIO\ArtesanusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('username')
                ->add('email')
                ->add('groups','entity', array(
                    'class' => 'ArtesanIO\ArtesanusBundle\Entity\Groups',
                    'property' => 'name',
                    'empty_value' => 'artesanus.form.empty_value',
                    'translation_domain' => 'ArtesanusBundle',
                ))
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

    // public function getParent()
    // {
    //     return 'fos_user_profile';
    // }

    /**
     * @return string
     */
    public function getName()
    {
        return 'users_type';
    }
}
