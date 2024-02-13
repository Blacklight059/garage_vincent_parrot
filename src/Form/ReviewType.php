<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rating',TextType::class, [
                'attr' => [                
                    'id' => "input-21d",
                    'value' => "2",
                    'type' => "text",
                    'class' => "rating",
                    'data-theme' => "krajee-fas",
                    'data-min' => 0,
                    'data-max' => 5,
                    'data-step' => 1,
                    'data-size' => "sm",
                ],
            ])
            ->add('email',EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'
            ])
            ->add('pseudo',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Pseudo'
            ])
            ->add('content', TextareaType::class, [
                'required' => true, 
                'label' => 'Votre message',
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
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}