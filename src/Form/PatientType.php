<?php

namespace App\Form;

use App\Entity\Allergen;
use App\Entity\Diet;
use App\Entity\Patient;
use App\Entity\Recipe;
use App\Repository\AllergenRepository;
use App\Repository\DietRepository;
use App\Repository\RecipeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('fullName', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50',
            ],
            'label' => 'Nom / Prénom',
            'label_attr' => [
                'class' => 'form-label  mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50])
            ]
        ])

        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
                'minLength' => '2',
                'maxLength' => '180'
            ],
            'label' => 'Email',
            'label_attr' => [
                'class' => 'form-label mt-4',
                
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 180]),
                new Assert\Email(),
                new Assert\NotBlank()
            ]
        ])
        ->add('allergens', EntityType::class,[
            'attr' => [
                'class' => 'form-control'
            ],
            'required' => false,
            'class' => Allergen::class,
            'query_builder' => function (AllergenRepository $r) {
                return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC');
            },
            'choice_label' => 'name',
            'multiple' => true
        ])
     
        ->add('diets', EntityType::class,[
            'attr' => [
                'class' => 'form-control'
            ],
            'class' => Diet::class,
            'query_builder' => function (DietRepository $r) {
                return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC');
            },
            'choice_label' => 'name',
            'multiple' => true
        ])
        ->add('recipes', EntityType::class,[
            'attr' => [
                'class' => 'form-control'
            ],
            
            'class' => Recipe::class,
            'query_builder' => function (RecipeRepository $r) {
                return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC');
            },
            'choice_label' => 'name',
            'multiple' => true
        ])
       
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4'
            ]
        ]);
    ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
