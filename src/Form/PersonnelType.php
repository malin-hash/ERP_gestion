<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\Personnel;
use App\Entity\Poste;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('datenaisse', null, [
                'widget' => 'single_text',
                'label' => 'Date de naissance'
            ])
            ->add('dateentre', null, [
                'widget' => 'single_text',
                'label' => "Date d'entré dans l'entreprise"
            ])
            ->add('poste', EntityType::class, [
                'class' => Poste::class,
                'choice_label' => 'poste',
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'nom',
            ])
            ->add('material', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'nom',
                'label' => 'Matériel Utilisé'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
