<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistTransfetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /* ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'Artist',
                'mapped' => false,
                ]*/
            ->add('agent', EntityType::class, [
                'class' => Agent::class,
                'choice_label' => 'Agent',
             
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
