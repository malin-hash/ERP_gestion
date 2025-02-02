<?php

namespace App\Form;

use App\Entity\Equipement;
use App\Entity\Generation;
use App\Entity\Marque;
use App\Entity\Ordinateur;
use App\Entity\System;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdinateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('core', TextType::class, [
                'label' => 'Le Core'
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('type', EntityType::class, [
                'class' => Equipement::class,
                'choice_label' => 'materiel',
                'label' => 'Type de l\'équipement'
            ])
            ->add('generation', EntityType::class, [
                'class' => Generation::class,
                'choice_label' => 'nom',
                'label' => 'Génération'
            ])
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'nom',
                'label' => 'Marque'
            ])
            ->add('systeme', EntityType::class, [
                'class' => System::class,
                'choice_label' => 'nom',
                'label' => 'Système'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ordinateur::class,
        ]);
    }
}
