<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '255',
                ],
                'label' => 'Nom et Prénom',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'required' => true,
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 255]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('note', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'required'=> false,
                'label'=> 'Note' ,
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => false,
                'required' => false,
                'mapped' => false
            ])
            ->add('isApproved',ChoiceType::class, [
                'choices'  => [
                    'En attente' => 'En attente',
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
                'required'=> false,
                'label'=> $options['label'],
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Valider',
                ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'label' => false,
        ]);
    }
}
