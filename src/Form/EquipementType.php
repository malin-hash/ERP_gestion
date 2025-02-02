<?php

namespace App\Form;

use App\Entity\Equipement;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('materiel', ChoiceType::class, [
                'label' => 'Type d\'equipement',
                'choices' => [
                    'imprimante' => 'imprimante',
                    'ordinateur' => 'ordinateur',
                    'unite centrale' => 'unite centrale'
                ]

            ])
            ->add('date', null, [
                'widget' => 'single_text',
                'label' => 'La date d\'achat'
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Le Prix'
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'La quantité'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
