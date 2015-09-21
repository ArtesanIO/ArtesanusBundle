<?php

namespace ArtesanIO\ACLBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupFormType extends AbstractType
{
    protected $grupo;
    protected $roles;

    public function __construct($grupo, $roles)
    {
        $this->grupo = $grupo;
        $this->roles = $roles;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('roles','choice', array(
            'choices'   => $this->getRoles(),
            'data'      => $this->grupo->getRoles(),
            'expanded'  => true,
            'multiple'  => true
        ))
        ;
    }

    public function getParent()
    {
        return 'fos_user_group';
    }

    public function getName()
    {
        return 'artesanio_user_group';
    }

    public function getRoles()
    {
        $roles = [];

        foreach($this->roles as $role){
            $roles[$role->getRoleKey()] = $role->getRoleKey();
        }

        return $roles;
    }

    public function getGroupsRoles()
    {
        $groups = [];

        foreach($this->grupo->getRoles() as $groupRole){
            $groups[$groupRole] = $groupRole;
        }

        return $groups;
    }
}
