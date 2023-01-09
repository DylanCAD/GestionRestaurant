<?php

namespace App\Form;

use App\Entity\Sauce;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SauceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomSauce', TextType::class,[
                'label'=> "Nom de la sauce",
                'attr'=>[
                    "placeholder"=>"Saisir le nom de la sauce"
                ]
            ])
            ->add('prixSauce', NumberType::class,[
                'label'=> "Prix de la sauce",
                'attr'=>[
                    "placeholder"=>"Saisir le prix de la sauce"
                ]
            ])
            ->add('imageSauce', TextType::class,[
                'label'=> "Image de la sauce",
                'attr'=>[
                    "placeholder"=>"Saisir l'image de la sauce"
                ]
            ])
            
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sauce::class,
        ]);
    }
}
