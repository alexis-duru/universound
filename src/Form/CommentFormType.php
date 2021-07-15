<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Your message here',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'please enter a comment',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'you need to be write something for add comment',
                        'max' => 200,
                        'maxMessage' => 'the comment cannot exceed 200 characters',
                        // max length allowed by Symfony for security reasons
                        // 'max' => 4096,
                    ]),
                ],
            ])

            ->add('comment', SubmitType::class)
            

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
