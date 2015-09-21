<?php

namespace ArtesanIO\ArtesanusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\ArtesanusBundle\Form\EventListener\UserSubscriber;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserType extends AbstractType
{
    protected $security;

    public function __construct(SecurityContext $security)
    {
        $this->security = $security;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('enabled')
                ->add('groups', 'entity', array(
                    'class' => 'ArtesanusBundle:Group',
                    'property' => 'name',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => true,
                    'empty_value' => '--Seleccione un Grupo--',
                ))
                ->add('name')
                ->add('email')
                ->add('username')
                ->addEventSubscriber(new UserSubscriber($this->security))
                ->add('current_password', 'password', array(
                    'label' => 'form.current_password',
                    'translation_domain' => 'FOSUserBundle',
                    'mapped' => false,
                    'constraints' => new UserPassword(),
                ))
            ;

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\ArtesanusBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'artesanus_user_type';
    }
}
