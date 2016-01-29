<?php

namespace ArtesanIO\ArtesanusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('categories', 'entity', array(
                'class' => 'ArtesanusBundle:Categories',
                'property' => 'category',
                'expanded' => false,
                'empty_value' => 'artesanus.form.empty_value',
                'translation_domain' => 'ArtesanusBundle',
            ))
            ->add('file')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\ArtesanusBundle\Entity\Files',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'files_type';
    }
}
