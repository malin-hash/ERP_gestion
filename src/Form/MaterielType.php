<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du matériel'
            ])
            ->add('datebuy', null, [
                'widget' => 'single_text',
                'label' => 'Date d\'achat'
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Prix unitaire'
            ])
            ->add('quantite', IntegerType::class, [
                'label' => 'Quantité'
            ])
            ->add('rame', IntegerType::class, [
                'label' => 'Capacité de la rame'
            ])
            ->add('disque', IntegerType::class, [
                'label' => 'Capacité du disque'
            ])
            ->add('core', TextType::class, [
                'label' => 'Type Core'
            ])
            ->add('systeme', TextType::class, [
                'label' => 'Système D\'exploitation'
            ])
            ->add('generation', TextType::class, [
                'label' => 'Génération de L\'ordinateur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
