<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Type;
use App\Entity\Sauce;
use App\Entity\Boisson;
use App\Entity\Accompagnement;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMenu', TextType::class,[
                'label'=> "Nom du menu",
                'attr'=>[
                    "placeholder"=>"Saisir le nom du menu"
                ]
            ])
            ->add('prixMenu', NumberType::class,[
                'label'=> "Prix du menu",
                'attr'=>[
                    "placeholder"=>"Saisir le prix du menu"
                ]
            ])
            ->add('imageMenu', TextType::class,[
                'label'=> "Image du menu",
                'attr'=>[
                    "placeholder"=>"Saisir l'image du menu"
                ]
            ])
            ->add('descriptionMenu', CKEditorType::class,[
                'config_name'=>'config_complete',
                'label'=> "Description du menu",
                'attr'=>[
                    "placeholder"=>"Saisir la description du menu"
                ]
            ])
            ->add('type', EntityType::class, [ 
                'label'=> "Type du menu",
                'class' => Type::class,
                'choice_label' => 'genretype'
            ])

            ->add('boissons', EntityType::class, [ 
                'label'=> "Boisson du menu",
                'class' => Boisson::class,
                'choice_label' => 'nom'
            ])

            ->add('accompagnements', EntityType::class, [ 
                'label'=> "Accompagnement du menu",
                'class' => Accompagnement::class,
                'choice_label' => 'nomAccompagnement'
            ])

            ->add('sauces', EntityType::class, [ 
                'label'=> "Sauce du menu",
                'class' => Sauce::class,
                'choice_label' => 'nomSauce'
            ])
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
