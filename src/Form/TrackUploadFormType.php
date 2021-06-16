<?php

namespace App\Form;

use App\Entity\Track;
use App\Form\TrackUploadFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackUploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('artwork')
            ->add('createdAt')
            ->add('label')
            ->add('genre')
            ->add('details')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Track::class,
        ]);
    }
}
