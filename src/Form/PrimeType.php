<?php

namespace App\Form;

use App\Entity\Poste;
use App\Entity\Prime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Prime1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Libelle', TextType::class, [
                'label' => 'Description'
            ])
            ->add('montant', IntegerType::class, [
                'label' => 'Le montant'
            ])
            ->add('poste', EntityType::class, [
                'class' => Poste::class,
                'choice_label' => 'poste',
                'multiple' => true,
                'lable' => 'Le Poste'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prime::class,
        ]);
    }
}
