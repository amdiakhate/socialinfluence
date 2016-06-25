<?php

namespace OfferBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

/**
 * Created by PhpStorm.
 * User: maxta
 * Date: 25/06/2016
 * Time: 13:17
 */
class OfferType extends AbstractType
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->user;
        $builder
            ->add('title')
            ->add('description')
            ->add('network', 'entity',array(
                'class' =>'UserBundle:Network',
                'query_builder'=>function (EntityRepository $entityRepository) use($user){
                    return $entityRepository->createQueryBuilder('n')
                        ->where('n.user = :user_id')
                        ->setParameter('user_id',$this->user->getId());
                },
                'property'=>'username'
            ))
            ->add('price')
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OfferBundle\Entity\Offer'
        ));
    }

}