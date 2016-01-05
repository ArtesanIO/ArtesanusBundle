<?php

namespace ArtesanIO\ArtesanusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\ArtesanusBundle\Model\RolesManager;
use ArtesanIO\ArtesanusBundle\Form\EventListener\GroupSubscriber;

class GroupsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name')
            ->add('roles', 'collection', array(
                'type' => 'artesanus_groups_roles_type',
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ))
        ;

        //$builder->addEventSubscriber(new GroupSubscriber());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\ArtesanusBundle\Entity\Groups'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'artesanus_groups_type';
    }
}