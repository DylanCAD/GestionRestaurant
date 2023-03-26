<?php

namespace App\Form;


use App\Entity\Type;
use App\Model\FiltreMenu;
use App\Repository\TypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FiltreMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMenu', TextType::class, [
                'attr'=>[
                    'placeholder'=>"Saisir une partie du nom du menu recherché"
                ],
                'required'=>false,
                'label'=>"Recherche sur le nom du menu"
            ])
            ->add('type', EntityType::class, [ 
                'class' => Type::class,
                'query_builder'=>function(TypeRepository $repo){
                    return $repo->listeTypeSimple();
                },
                'choice_label' => 'genretype',
                'label'=>"Genre du menu",
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'method'=>'get',
            'csrf_protection'=>false,
            'data_class'=> FiltreMenu::class
        ]);
    }
}
