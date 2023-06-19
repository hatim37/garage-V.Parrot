<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use App\Repository\ImagesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CarType extends AbstractType
{

 
    private $imagesRepository;

    public function __construct(ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;

    }


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
                'required' => true,
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 255]),
                    new Assert\NotBlank()
                ],
            ])
            ->add('price', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prix',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\NotBlank()
                ],
                'required' => true
            ])
            ->add('year', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mise en circulation',
                'required' => true,
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                 'constraints' => [
                    new Assert\NotBlank()
                ],
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
                    new Assert\NotBlank()
                ],'required' => true,
            ]) 
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'required' => $options['required'],
                'mapped' => false,
            ])
            ->add('type', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Type de véhicule ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false,
            ])
            ->add('fuel', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Carburant',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false,
            ])
            ->add('color', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Couleur ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false,
            ])
            ->add('gearbox', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Boite de vitesse ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false,
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
                ],
                'required' => false,
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
                ],
                'required' => false,
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
                ],
                'required' => false,
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
                ],
                'required' => false,
            ])
            ->add('emission', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Émission CO2',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false,
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
                'label' => 'Selectionner des options ( Vous pouvez créer une option et taper "entrée" pour valider)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'name',
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
            'required' => true,
        ]);
    }
}

