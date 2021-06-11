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

class ClientType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
       $nom = $_GET["nom"];
      // $id = $_GET["id"];
    
        
        $builder
            ->add('voiture',EntityType::class,['class' => Voiture::class,'placeholder'=>$nom,'choice_label' => 'nom'])
            /*->add('voiture', ChoiceType::class, [
                'choices'  => [$nom => $id]
                ])*/
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class,array('label' => 'Prénom'))
            ->add('adresse',TextType::class)
            ->add('tel',TextType::class,['attr' => ['placeholder' => 'N°Télèphone'],])
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
