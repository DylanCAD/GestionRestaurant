<?php

namespace App\Form;

use App\Entity\Accompagnement;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AccompagnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAccompagnement', TextType::class,[
                'label'=> "Nom de l' accompagnement",
                'attr'=>[
                    "placeholder"=>"Saisir le nom de l' accompagnement"
                ]
            ])
            ->add('prixAccompagnement', NumberType::class,[
                'label'=> "Prix de l' accompagnement",
                'attr'=>[
                    "placeholder"=>"Saisir le prix de l' accompagnement"
                ]
            ])
            ->add('imageAccompagnement', TextType::class,[
                'label'=> "Image de l' accompagnement",
                'attr'=>[
                    "placeholder"=>"Saisir l'image de l' accompagnement"
                ]
            ])
            
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Accompagnement::class,
        ]);
    }
}
