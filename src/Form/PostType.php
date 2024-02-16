<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Energy;
use App\Entity\Option;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true, 
                'label' => 'Titre',
                'constraints' => [
                    new NotBlank([
                    'message' => "Veuillez saisir un nom"
                    ]),
                    new Length([
                    'min' => 6,
                    'minMessage' => "Le titre doit contenir au minimum {{ limit }} caractères"
                    ]),
                ],
                'row_attr' => [
                    'class' => 'm-3',
                ],
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
            ])
            ->add('energy', EntityType::class, [
                'class' => Energy::class,
                'choice_label' => 'name',
            ])
            ->add('description', TextareaType::class, [
                'required' => true, 
                'label' => 'Description',
                'constraints' => [
                    new NotBlank([
                       'message' => 'Veuillez saisir votre message'
                    ]),
                    new Length([
                       'min' => 6,
                       'minMessage' => 'Le message doit contenir au minimum {{ limit }} caractères'
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'rows' => "10",
                    'cols' => "50",
                ],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'row_attr' => [
                    'class' => 'm-3',
                ],
            ])
            ->add('year', NumberType::class, [
                'label' => 'Année',
                'row_attr' => [
                    'class' => 'm-3',
                ],
            ])
            ->add('kilometer', NumberType::class, [
                'label' => 'Kilomètre',
                'row_attr' => [
                    'class' => 'm-3',
                ],
            ])            
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                "multiple" => true,
            ])
            ->add('images', FileType::class, [
                'label' => false,
                'mapped' => false,
                "multiple" => true,
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
