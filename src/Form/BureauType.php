<?php

namespace App\Form;

use App\Entity\Bureau;
use App\Entity\Imprimante;
use App\Entity\Ordinateur;
use App\Entity\Unitecentral;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BureauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule', TextType::class, [
                'label' => 'Numéro du bureau'
            ])
            ->add('ordinateur', EntityType::class, [
                'class' => Ordinateur::class,
                'choice_label' => 'nom',
                'label' => 'Ordinateur'
            ])
            ->add('imprimante', EntityType::class, [
                'class' => Imprimante::class,
                'choice_label' => 'nom',
                'label' => 'Imprimante'
            ])
            ->add('unitecentral', EntityType::class, [
                'class' => Unitecentral::class,
                'choice_label' => 'nom',
                'label' => 'Unité Central'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bureau::class,
        ]);
    }
}
