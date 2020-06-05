<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login',TextType::class,[
                'label' => 'Login:',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('password',PasswordType::class,[
                'label' => 'Mot de passe:',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('firstname',TextType::class,[
                'label' => 'Prénom:',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label' => 'Nom:',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email',EmailType::class,[
                'label' => 'Email:',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('langue', ChoiceType::class, [
                'choices'=>[
                    '' => null,
                    'Français' => 'fr',
                    'Anglais' => 'en',
                ]
            ])

            //L'utilisateur ne peut pas choisir le rôle qu'il a
            //->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
