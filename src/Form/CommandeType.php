<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Client;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('client', EntityType::class, [ 
            'class' => Client::class,
            'choice_label' => 'nomCli',
            'label'=> "Choisissez le client",

        ])
        ->add('menus', EntityType::class, [ 
                'class' => Menu::class,
                'choice_label' => 'nomMenu',
                'label'=> "Menu(s)",
                'multiple'=>true,
                'by_reference'=>false,
                'attr'=>[
                    'class'=>"selectCommandes"
                ]
            ])
        
            ->add('dateCom', DateType::class,[
                'label'=> "Date d'aujourd'hui",
                'attr'=>[
                    "placeholder"=>"Saisir la date d'aujourd'hui"
                ]
            ])
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
