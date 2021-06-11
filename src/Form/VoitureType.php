<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Marque;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('modele',TextType::class,array('label' => 'Modèle'))
            ->add('marques',EntityType::class,['class' => Marque::class,'placeholder'=>'choisissez un marque','choice_label' => 'nom'])
            ->add('couleur')
            ->add('porte')
            ->add('place')
            ->add('bagage')
            ->add('transmission')
            ->add('age',TextType::class,array('label' => 'Âge'))
            ->add('disponible', ChoiceType::class, ['choices'  => ['Oui' => true,'Non' => false]])
            ->add('pubvoiture', ChoiceType::class, ['choices'  => ['Non' => false,'Oui' => true]])
            ->add('prixparjour',IntegerType::class,array('label' => 'Prix par Jour'))
            ->add('remise',IntegerType::class,array('label' => 'Remise'))
            ->add('image', FileType::class, array('data_class' => null, 'label' => 'Image'))
           //->add('clients')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
