<?php

namespace App\Form;

use App\Entity\Poste;
use App\Entity\Salaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PosteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('poste', TextType::class, [
                'label' => 'Le Poste'
            ])
            ->add('salaire', EntityType::class, [
                'class' => Salaire::class,
                'choice_label' => 'salaire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Poste::class,
        ]);
    }
}
