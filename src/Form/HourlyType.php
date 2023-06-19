<?php

namespace App\Form;

use App\Entity\Hourly;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HourlyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                ],
                'label' => 'Jour :',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'disabled' => true
            ])
            ->add('timeStartMorning', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=> false,
                'label' => 'Heure début matin',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('timeEndMorning', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=> false,
                'label' => 'Heure fin matin',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('closeMorning', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'required' => false,
                'label'=> 'Fermeture matin'
            ])
            ->add('timeStartAfternoon', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Heure début après-midi',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('timeEndAfternoon', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Heure fin après-midi',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('closeAfternoon', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'required' => false,
                'label'=> 'Fermeture après-midi'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Modifier',
                ]);
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hourly::class,
        ]);
    }
}
