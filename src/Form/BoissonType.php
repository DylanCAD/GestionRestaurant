<?php

namespace App\Form;

use App\Entity\Boisson;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BoissonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=> "Nom de la boisson",
                'attr'=>[
                    "placeholder"=>"Saisir le nom de la boisson"
                ]
            ])
            ->add('prix', NumberType::class,[
                'label'=> "Prix de la boisson",
                'attr'=>[
                    "placeholder"=>"Saisir le prix de la boisson"
                ]
            ])
            ->add('image', TextType::class,[
                'label'=> "Image de la boisson",
                'attr'=>[
                    "placeholder"=>"Saisir l'image de la boisson"
                ]
            ])
            
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Boisson::class,
        ]);
    }
}
