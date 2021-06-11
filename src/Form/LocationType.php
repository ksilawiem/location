<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Client;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clients', EntityType::class,['class' => Client::class,'placeholder'=>'choisissez un client','choice_label' => function ($client) {
                return $client->getPrenom() . ' ' . $client->getNom();
            }])
            ->add('voitures', EntityType::class,['class' => Voiture::class,'placeholder'=>'choisissez une voiture','choice_label' => 'nom'])
            ->add('datedebut', DateType::class,array('label'=>'Date de Début'),['widget' => 'choice', 'format' => 'dd-MM-yyyy'])
            ->add('datefin', DateType::class,array('label'=>'Date de Fin'),['widget' => 'choice', 'format' => 'dd-MM-yyyy'])
            ->add('valider', ChoiceType::class, ['choices'  => ['Non' => '0','Oui' => '1']])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}

