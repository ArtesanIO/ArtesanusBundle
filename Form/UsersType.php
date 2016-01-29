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
                ->add('active')
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
        return 'users_type';
    }
}
