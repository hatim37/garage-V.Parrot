<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '255',
                ],
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'required' => true
            ])
            ->add('price', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prix ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                ],'required' => true
            ])
            ->add('year', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mise en circulation',
                'required' => true,
                'by_reference' => true,
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
                ])
            ->add('kilometer', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Kiomètrage ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                ],'required' => true
            ]) 
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'required' => false,
                'mapped' => false
            ])
            ->add('type', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Type de véhicule ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('fuel', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Carburant',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('color', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Couleur ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('gearbox', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Boite de vitesse ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('fiscalPower', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Puissance Fiscal (6CV)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(200)
                ]
            ])
            ->add('realPower', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Puissance réel (110CV) ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(500)
                ]
            ])
            ->add('numberOfDoor', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre de porte ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(10)
                ]
            ])
            ->add('numberOfPlace', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre de place ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(20)
                ]
            ])
            ->add('emission', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Émission CO2',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('equipment', EntityType::class, [
                'class' => Equipment::class,
                'query_builder' => function (EquipmentRepository $r) {
                    return $r->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'attr' => [
                    'class' => 'select2 form-control mt-4'
                ],
                'label' => 'Ajouter des options',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'name',
                'placeholder' => 'selectionner un ou des équipements',
                'multiple' => true,
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Valider'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}

