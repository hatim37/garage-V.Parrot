<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('kilometerMin', IntegerType::class, [
                'required'=> false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder'=> 'km'
                ],
                'label'=>'Minimum',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new Assert\Positive(),
                ]
            ])
            ->add('kilometerMax', IntegerType::class, [
                'required'=> false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder'=> 'km'
                ],
                'label'=> 'Maximum',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new Assert\Positive(),
                ]
            ])
            ->add('priceMin', IntegerType::class, [
                'required'=> false,
                
                'label'=> 'Minimum',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder'=> '€'
                ],
                'constraints' => [
                    new Assert\Positive(),
                ]
            ])
            ->add('priceMax', IntegerType::class, [
                'required'=> false,
                'label'=> 'Maximum',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr'=> [
                    'class' => 'form-control',
                    'placeholder'=> '€'
                ],
                'constraints' => [
                    new Assert\Positive(),
                ]
            ])
            ->add('yearMin', IntegerType::class, [
                'required'=> false,
                'label'=> 'Minimum',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr'=> [
                    'class' => 'form-control',
                    'placeholder'=> 'Année'
                ],
            ])
            ->add('yearMax', IntegerType::class, [
                'required'=> false,
                'label'=> 'Maximum',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr'=> [
                    'class' => 'form-control',
                    'placeholder'=> 'Année'
                ],
            ])
            ->add('sortBy', ChoiceType::class, [
                'choices'  => [
                    'Tri : Prix croissants' => 'priceMin',
                    'Tri : Prix décroissants' => 'priceMax',
                    'Tri : Année croissants' => 'yearMin',
                    'Tri : Année décroissants' => 'yearMax',
                    'Tri : Kilomètrage croissants' => 'kilometerMin',
                    'Tri : Kilomètrage décroissants' => 'kilometerMax',
                ],
                'placeholder'=> 'Trier par',
                'required'=> false,
                'attr' => [
                    'class' => 'form-control mt-4',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label'=> 'Rechercher',
                
                ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method'=> 'GET',
            'csrf_protection' => false,
        ]);
    }

    /**
     * Cette function modifie l'affichage de l'url après une recherche
     *
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
