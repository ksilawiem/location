<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType2 extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voiture',EntityType::class,['class' => Voiture::class,'placeholder'=>'Choisissez une voiture','choice_label' => 'nom'])
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class,array('label' => 'Prénom'))
            ->add('adresse',TextType::class)
            ->add('tel',TextType::class,array('label' => 'N°Télèphone'))
            ->add('email',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
