<?php
namespace UserBundle\Form;

/**
 * Created by PhpStorm.
 * User: maxta
 * Date: 22/06/2016
 * Time: 22:01
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('description')
            ->add('imageFile','file',array(
                'required'=>false
            ))
            ->add('language');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }
}