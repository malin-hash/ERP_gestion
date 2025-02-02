<?php

namespace App\Form;

use App\Entity\Equipement;
use App\Entity\Marque;
use App\Entity\Unitecentral;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnitecentralType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => Equipement::class,
                'choice_label' => 'materiel',
                'label' => 'Type l\'équipement'

            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'nom',
                'label' => 'Marque'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Unitecentral::class,
        ]);
    }
}
