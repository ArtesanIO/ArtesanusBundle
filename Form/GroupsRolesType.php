<?php

namespace ArtesanIO\ArtesanusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupsRolesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles','entity', array(
                'class' => 'ArtesanusBundle:Roles',
                'property' => 'role',
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
            'data_class' => 'ArtesanIO\ArtesanusBundle\Entity\GroupsRoles'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'artesanus_groups_roles_type';
    }
}
